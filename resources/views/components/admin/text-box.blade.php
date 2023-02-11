<label class="block {{ $class }}">
    <span class="text-xs text-gray-700">{{ $label }}</span>
    <input type="{{ $type }}"
        class="block w-full px-2 py-1 rounded form-input disabled:bg-gray-200 disabled:text-gray-600"
        placeholder="{{ $placeholder }}"
        @if ($debounced) wire:model.defer="{{ $name }}"
      @else
          wire:model.debounce.500ms="{{ $name }}" @endif
        @if ($disabled) disabled @endif />
    @error($name)
        <span class="text-xs text-red-500">{{ $message }}</span>
    @enderror
</label>
