<?php

namespace App\Services;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

/**
 * AiBridgeService
 * ================
 *
 * Laravel integration layer for the FastAPI Context Builder sidecar.
 *
 * Calls POST /build-context on the Python FastAPI server and returns
 * structured context arrays. No chatbot, no LLM calls — just context retrieval.
 *
 * Usage:
 *     $bridge = app(AiBridgeService::class);
 *     $ctx    = $bridge->buildContext('mutasi siswa');
 *     $prompt = $ctx['combined_context'];
 */
class AiBridgeService
{
    protected string $baseUrl;
    protected int $timeout;
    protected int $connectTimeout;
    protected int $retries;
    protected int $retryDelay;
    protected bool $cacheEnabled;
    protected int $cacheTtl;

    public function __construct()
    {
        $this->baseUrl        = config('ai-bridge.base_url', 'http://127.0.0.1:8000');
        $this->timeout        = config('ai-bridge.timeout', 30);
        $this->connectTimeout = config('ai-bridge.connect_timeout', 5);
        $this->retries        = config('ai-bridge.retries', 2);
        $this->retryDelay     = config('ai-bridge.retry_delay', 200);
        $this->cacheEnabled   = config('ai-bridge.cache.enabled', false);
        $this->cacheTtl       = config('ai-bridge.cache.ttl', 300);
    }

    /**
     * Build aggregated context for a natural-language query.
     *
     * Returns an associative array with keys:
     *   - code_context    (array)
     *   - rag_context     (array)
     *   - memory_context  (array)
     *   - summary_context (string)
     *   - combined_context (string)
     *
     * On failure returns an array with 'error' and 'combined_context' keys.
     *
     * @param  string  $query  Natural-language query (1–1000 chars)
     * @return array<string, mixed>
     */
    public function buildContext(string $query): array
    {
        $query = trim($query);

        if ($query === '') {
            return $this->errorResponse('Query cannot be empty.');
        }

        if (mb_strlen($query) > 1000) {
            return $this->errorResponse('Query exceeds 1000 character limit.');
        }

        // ── Cache lookup ─────────────────────────────────────────────
        if ($this->cacheEnabled) {
            $cacheKey = 'ai_bridge:' . md5($query);
            $cached   = Cache::get($cacheKey);

            if ($cached !== null) {
                Log::debug('[AiBridge] Cache hit', ['query' => $query]);
                return $cached;
            }
        }

        // ── HTTP request ─────────────────────────────────────────────
        try {
            $response = Http::baseUrl($this->baseUrl)
                ->timeout($this->timeout)
                ->connectTimeout($this->connectTimeout)
                ->retry($this->retries, $this->retryDelay, function (\Exception $e) {
                    // Only retry on connection errors or 5xx — not on 4xx
                    return $e instanceof ConnectionException
                        || ($e instanceof RequestException && $e->response->serverError());
                })
                ->acceptJson()
                ->post('/build-context', [
                    'query' => $query,
                ]);

            if ($response->successful()) {
                $data = $response->json();

                // Normalise — guarantee all expected keys exist
                $result = [
                    'code_context'    => $data['code_context']    ?? [],
                    'rag_context'     => $data['rag_context']     ?? [],
                    'memory_context'  => $data['memory_context']  ?? [],
                    'summary_context' => $data['summary_context'] ?? '',
                    'combined_context' => $data['combined_context'] ?? '',
                ];

                if ($this->cacheEnabled) {
                    Cache::put($cacheKey, $result, $this->cacheTtl);
                }

                Log::debug('[AiBridge] Context built', [
                    'query'        => $query,
                    'code_chunks'  => count($result['code_context']),
                    'rag_chunks'   => count($result['rag_context']),
                    'memory_items' => count($result['memory_context']),
                ]);

                return $result;
            }

            // Non-2xx response
            $body = $response->json() ?? $response->body();
            Log::warning('[AiBridge] Non-2xx response', [
                'status' => $response->status(),
                'body'   => $body,
                'query'  => $query,
            ]);

            return $this->errorResponse(
                "AI Bridge returned HTTP {$response->status()}.",
                $response->status()
            );

        } catch (ConnectionException $e) {
            Log::error('[AiBridge] Connection failed', [
                'message' => $e->getMessage(),
                'url'     => $this->baseUrl,
            ]);

            return $this->errorResponse(
                'Cannot connect to AI Bridge. Is the FastAPI server running?'
            );

        } catch (RequestException $e) {
            Log::error('[AiBridge] Request failed', [
                'message' => $e->getMessage(),
                'status'  => $e->response?->status(),
            ]);

            return $this->errorResponse(
                'AI Bridge request failed: ' . $e->getMessage()
            );

        } catch (\Throwable $e) {
            Log::error('[AiBridge] Unexpected error', [
                'exception' => get_class($e),
                'message'   => $e->getMessage(),
            ]);

            return $this->errorResponse(
                'Unexpected AI Bridge error: ' . $e->getMessage()
            );
        }
    }

    /**
     * Health-check the FastAPI sidecar.
     *
     * @return array{online: bool, project_root: string|null, error: string|null}
     */
    public function health(): array
    {
        try {
            $response = Http::baseUrl($this->baseUrl)
                ->timeout(5)
                ->connectTimeout(3)
                ->acceptJson()
                ->get('/health');

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'online'       => true,
                    'project_root' => $data['project_root'] ?? null,
                    'error'        => null,
                ];
            }

            return [
                'online'       => false,
                'project_root' => null,
                'error'        => "HTTP {$response->status()}",
            ];
        } catch (\Throwable $e) {
            return [
                'online'       => false,
                'project_root' => null,
                'error'        => $e->getMessage(),
            ];
        }
    }

    /**
     * Check if the FastAPI sidecar is reachable.
     */
    public function isOnline(): bool
    {
        return $this->health()['online'];
    }

    /**
     * Build a standardised error response with empty context arrays.
     */
    protected function errorResponse(string $message, int $httpStatus = 0): array
    {
        return [
            'code_context'    => [],
            'rag_context'     => [],
            'memory_context'  => [],
            'summary_context' => '',
            'combined_context' => '',
            'error'           => $message,
            'http_status'     => $httpStatus,
        ];
    }
}
