@props(['class' => ''])

<a {{ $attributes->merge(['class' => 'rounded-lg border border-border bg-base-100 shadow-sm p-4 text-sm ' . $class]) }}>
  {{ $slot }}
</a>