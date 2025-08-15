<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center px-4 py-2 font-semibold text-xs text-white uppercase tracking-widest rounded-md transition ease-in-out duration-150',
    ]) }}
    style="background: linear-gradient(90deg, #6366f1 0%, #a21caf 100%); border: none; box-shadow: 0 2px 8px 0 rgba(99,102,241,0.10);"
>
    {{ $slot }}
</button> 