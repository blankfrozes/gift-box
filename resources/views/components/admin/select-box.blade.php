<div class="flex items-center {{ $class }}">
    <label class="w-full">
        @if ($label)
            <span class="text-xs text-gray-700">{{ $label }}</span>
        @endif
        <select class="block w-full px-2 py-1 form-select" wire:model="{{ $name }}"
            @if ($disabled) disabled @endif>
            <option disabled selected value="">{{ $placeholder }}</option>
            @foreach ($options as $option)
                <option value="{{ $option['value'] }}">{{ $option['label'] }}</option>
            @endforeach
        </select>
        @error($name)
            <span class="text-xs text-red-500">{{ $message }}</span>
        @enderror
    </label>
</div>
