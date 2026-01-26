@props(['status' => 'pending'])

@php
  $base = 'inline-block rounded-full px-3 py-1 text-xs font-medium m-2 text-gray-100';
  $classes = $base;

  if ($status === 'pending') {
      $classes .= ' bg-yellow-500  border border-yellow-100';
  } elseif ($status === 'in_progress') {
      $classes .= ' bg-blue-500  border border-blue-100';
  } elseif ($status === 'completed') {
      $classes .= ' bg-green-500  border border-green-100 ';
  }
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
  {{ \Str::headline($status) }}
</span>