{{-- resources/views/operator/partials/_stepNav.blade.php --}}
{{-- Penggunaan: @include('operator.partials._stepNav', ['step'=>1,'max'=>5]) --}}
<div class="flex justify-between items-center mt-6">
    @if($step > 1)
        <button type="button" @click="goToStep({{ $step }}, {{ $step - 1 }})"
            class="text-[11px] font-bold text-slate-400 hover:text-slate-700 uppercase tracking-widest flex items-center gap-1 transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </button>
    @else
        <div></div>
    @endif

    @if($step < $max)
        <button type="button" @click="goToStep({{ $step }}, {{ $step + 1 }})"
            class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[11px] font-bold uppercase tracking-widest transition-all flex items-center gap-2 shadow-lg shadow-emerald-500/20">
            Berikutnya <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </button>
    @endif
</div>