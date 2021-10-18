@props(["options", "onSelectChange"])

<select
    {{ $attributes->merge(["class" => "select ellipsis"]) }}
    autocomplete="off"
    @change="{!! $onSelectChange !!}"
>
    @foreach ($options as $key => $value)
        <option class="select__option" value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>
