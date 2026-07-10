{{-- resources/views/operator/partials/_formFieldSelect.blade.php --}}
{{-- Penggunaan: @include('operator.partials._formFieldSelect', ['name'=>'agama','label'=>'Agama','options'=>['Islam','Kristen'],'optional'=>false]) --}}
<div class="flex flex-col gap-2">
    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
        @php
            $displayLabel = $label;
            $hasAsterisk = str_ends_with(trim($label), '*');
            if ($hasAsterisk) {
                $displayLabel = trim(substr(trim($label), 0, -1));
            }
        @endphp
        {{ $displayLabel }}
        @if ($hasAsterisk)
            <span class="text-rose-400">*</span>
        @endif
        @if (isset($optional) && $optional)
            <span class="font-normal normal-case opacity-60">(opsional)</span>
        @endif
    </label>
    <div class="relative">
        <select name="{{ $name }}" @if (isset($id)) id="{{ $id }}" @endif
            @if (isset($onchange)) @change="{{ $onchange }}" @endif
            class="w-full px-3 sm:px-4 py-3 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 outline-none transition-all text-sm text-slate-700 dark:text-slate-300 cursor-pointer appearance-none pr-10">
            @if (isset($placeholder))
                <option value="">{{ $placeholder }}</option>
            @endif
            @if (isset($options) && is_array($options))
                @foreach ($options as $key => $value)
                    @if (is_array($value))
                        <option value="{{ $key }}" {{ old($name) == $key ? 'selected' : '' }}>
                            {{ $value['label'] ?? $value }}</option>
                    @else
                        <option value="{{ $key }}" {{ old($name) == $key ? 'selected' : '' }}>
                            {{ $value }}
                        </option>
                    @endif
                @endforeach
            @endif
            {{ $slot ?? '' }}
        </select>
        <i data-lucide="chevron-down"
            class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400 pointer-events-none shrink-0"></i>
    </div>
</div>
