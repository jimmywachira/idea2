@props(['name','label'=>false, 'type' => 'text'])



<div class="space-y-2">
    @if ($label) 
    <label for="{{ $name }}" class="label">{{ $label }}</label>
    @endif

    @if($type === 'textarea')
    <textarea id="{{ $name }}" name="{{ $name }}" class="textarea" {{ $attributes }} placeholder="{{ $label }}" required>{{old($name)}}</textarea>
    @else

    <input id="{{ $name }}" type="{{ $type }}" name="{{ $name }}" class="input" {{ $attributes }} placeholder="{{ $label }}" required />
    @endif
    <x-form.error name="{{ $name }}" />
</div>