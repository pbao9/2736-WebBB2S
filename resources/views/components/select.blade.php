<select {{ $attributes->class(['form-select shadow-none'])->merge($isRequired()) }}>
    {{ $slot }}
</select>
