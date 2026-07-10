{{-- resources/views/operator/partials/_formField.blade.php --}}
{{-- Penggunaan: @include('operator.partials._formField', ['name'=>'nip','label'=>'NIP','placeholder'=>'...','type'=>'text','optional'=>true]) --}}
<div class="flex flex-col gap-2">
    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
        @php
            $displayLabel = $label;
            $hasAsterisk = str_ends_with(trim($label), '*');
            if ($hasAsterisk) { $displayLabel = trim(substr(trim($label), 0, -1)); }
        @endphp
        {{ $displayLabel }}
        @if($hasAsterisk)<span class="text-rose-400">*</span>@endif
        @if(isset($optional) && $optional)<span class="font-normal normal-case opacity-60">(opsional)</span>@endif
    </label>

    @if(($type ?? 'text') === 'textarea')
        <textarea
            name="{{ $name }}"
            @if(isset($id)) id="{{ $id }}" @endif
            rows="3"
            class="w-full px-3 sm:px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all text-sm text-slate-700 dark:text-slate-300 resize-none"
            placeholder="{{ $placeholder ?? '' }}"
        >{{ old($name) }}</textarea>
    @else
        <input
            type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            @if(isset($id)) id="{{ $id }}" @endif
            class="w-full px-3 sm:px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all text-sm text-slate-700 dark:text-slate-300"
            placeholder="{{ $placeholder ?? '' }}"
            value="{{ old($name) }}"
            @if(isset($min)) min="{{ $min }}" @endif
            @if(isset($max)) max="{{ $max }}" @endif
        >
    @endif
</div>