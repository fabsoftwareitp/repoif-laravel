@props(["options", "onSelectChange", "name"])

<select
    {{ $attributes->merge(["class" => "select ellipsis"]) }}
    name="{{ $name }}"
    @change="{!! $onSelectChange !!}"
>
    @foreach ($options as $key => $value)
        <option
            class="select__option"
            value="{{ $key }}"
            {{ old($name) == $key ? "selected" : "" }}
        >{{ $value }}</option>
    @endforeach
</select>
