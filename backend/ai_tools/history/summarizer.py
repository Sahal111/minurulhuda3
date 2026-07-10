"""
History Summarizer
==================

Logic for summarizing and compressing message histories.
Note: Since this runs as an AI agent tool, the actual summarization
can be done via an LLM call or rule-based truncation. Here we provide
the structure to orchestrate it.
"""

from typing import List, Dict, Tuple, Any
from .token_counter import TokenCounter
from .history_store import HistoryStore

class HistorySummarizer:
    """Compresses conversation history when it exceeds token limits."""
    
    def __init__(self, project_root: str, max_tokens: int = 4000, keep_recent: int = 3):
        self.max_tokens = max_tokens
        self.keep_recent = keep_recent * 2  # * 2 because user + assistant = 1 turn
        self.counter = TokenCounter()
        self.store = HistoryStore(project_root)
        
    def should_compress(self, messages: List[Dict[str, str]]) -> bool:
        """Check if history has grown too large."""
        # Quick check: if we don't have enough messages, don't compress
        if len(messages) <= self.keep_recent:
            return False
            
        token_count = self.counter.count_messages(messages)
        return token_count > self.max_tokens
        
    def prepare_compression_prompt(self, messages: List[Dict[str, str]], current_summary: str = "") -> str:
        """
        Creates a prompt to send to the LLM to generate a summary of older messages.
        Returns the text to summarize.
        """
        # Separate messages into "to summarize" and "to keep"
        to_keep = messages[-self.keep_recent:]
        to_summarize = messages[:-self.keep_recent]
        
        prompt_parts = [
            "Please compress the following conversation history into a concise summary.",
            "Focus strictly on:",
            "1. Technical decisions made",
            "2. User constraints provided",
            "3. Code files modified/discussed",
            "4. Current state of the task",
            "Omit conversational filler, apologies, and full code blocks.",
        ]
        
        if current_summary:
            prompt_parts.append("\nPrevious Summary:")
            prompt_parts.append(current_summary)
            
        prompt_parts.append("\nNew Messages to Summarize:")
        
        for msg in to_summarize:
            role = msg.get("role", "unknown").upper()
            content = msg.get("content", "")
            
            # Truncate extremely long code blocks in the summary context to save tokens
            if len(content) > 1000:
                content = content[:500] + "\n... [TRUNCATED] ...\n" + content[-500:]
                
            prompt_parts.append(f"{role}: {content}")
            
        return "\n".join(prompt_parts)
        
    def compress_history(self, messages: List[Dict[str, str]], generated_summary: str) -> List[Dict[str, str]]:
        """
        Reconstructs the message list using the new summary and the recent messages.
        """
        to_keep = messages[-self.keep_recent:]
        
        compressed_messages = [
            {
                "role": "system", 
                "content": f"PREVIOUS CONVERSATION SUMMARY:\n{generated_summary}\n\n(The conversation continues from here...)"
            }
        ]
        
        compressed_messages.extend(to_keep)
        return compressed_messages
