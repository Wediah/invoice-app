@props(['name', 'label' => null])

<x-form.field>
    <x-form.label name="{{ $name }}" label="{{ $label }}" />

    <div class="mt-2">
        <input class="border border-gray-400 rounded-lg p-2 w-full"
               name="{{ $name }}"
               id="{{ $name }}"
            {{ $attributes(['value' => old($name)]) }}
        >
    </div>


    <x-form.error name="{{ $name }}" />
</x-form.field>
