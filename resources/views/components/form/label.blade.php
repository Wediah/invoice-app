@props(['name'])

<label class="block text-sm font-medium leading-6 text-gray-900"
       for="{{ $name }}"
>
    {{ ucwords($name) }}
</label>
