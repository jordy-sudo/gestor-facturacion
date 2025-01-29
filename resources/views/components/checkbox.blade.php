@props([
    'id' => null,
    'name' => null,
    'value' => null,
    'checked' => false,
    'wireModel' => null,
])

<div>
    <input 
        type="checkbox"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $checked ? 'checked' : '' }}
        @if($wireModel) wire:model.defer="{{ $wireModel }}" @endif
        {{ $attributes->merge(['class' => 'rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500']) }}
    />
</div>
