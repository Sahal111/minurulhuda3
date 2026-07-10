{{-- operator/partials/_stepNavSiswa.blade.php --}}
{{-- Usage: @include('operator.partials._stepNavSiswa', ['step' => N, 'max' => 4]) --}}

<div class="flex justify-between items-center mt-6">
    @if ($step > 1)
        <button type="button" @click="goToStepSiswa({{ $step }}, {{ $step - 1 }})"
            class="text-[11px] font-bold text-slate-400 hover:text-slate-600 uppercase tracking-widest flex items-center gap-1">
            <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
        </button>
    @else
        <div></div>
    @endif

    @if ($step < $max)
        <button type="button" @click="goToStepSiswa({{ $step }}, {{ $step + 1 }})"
            class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl text-[11px] font-black uppercase tracking-widest shadow-lg shadow-emerald-500/30 active:scale-95 transition-all flex items-center gap-2">
            Berikutnya <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </button>
    @endif
</div>