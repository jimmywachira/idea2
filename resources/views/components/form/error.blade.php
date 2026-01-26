@props(['name'])
@error($name)
   <p class="text-error text-sm mt-2">{{ $message }}</p>
@enderror