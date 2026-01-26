@props(['name','label', 'type' => 'text'])

<div class="space-y-2">
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" class="input" {{ $attributes }} placeholder="{{ $label }}" required />
    <x-form.error name="{{ $name }}" />
</div>