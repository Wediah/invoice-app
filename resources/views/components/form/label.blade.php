@props(['name', 'label' => null])

<label class="block text-sm font-medium leading-6 text-gray-900"
       for="{{ $name }}"
>
    {{ $label ?? ucwords(str_replace('_', ' ', $name)) }}
</label>
