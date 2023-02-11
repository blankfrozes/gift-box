<div class="flex items-center {{ $class }}">
    <label class="flex items-center cursor-pointer">
        <input type="checkbox" class="cursor-pointer form-checkbox" wire:model.defer="{{ $name }}" />
        <span class="ml-2 text-sm text-gray-700">{{ $label }}</span>
        @error($name)
            <div class="text-xs text-red-500">{{ $message }}</div>
        @enderror
    </label>
</div>
