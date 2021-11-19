@props(["options", "onSelectChange", "name", "value"])

<select
    {{ $attributes->merge(["class" => "select ellipsis"]) }}
    name="{{ $name }}"
    value="{{ $value }}"
    @change="{!! $onSelectChange !!}"
>
    @foreach ($options as $key => $optionValue)
        <option
            class="select__option"
            value="{{ $key }}"
            {{ (old($name) == $key) || ((! old($name)) && $value && $value == $key) ? "selected" : "" }}
        >{{ $optionValue }}</option>
    @endforeach
</select>
