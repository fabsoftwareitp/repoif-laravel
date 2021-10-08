@props(["height", "maxlength", "value" => ""])

<div
    style="height: {{ $height }}px;"
    class="text-area-container"
    x-data="{ count: {{ mb_strlen($value) }} }"
>
    <textarea
        {{ $attributes->merge(["class" => "text-area"]) }}
        maxlength="{{ $maxlength }}"
        @keyup="count = $el.value.length"
    >{{ $value }}</textarea>

    <span
        class="text-area__counter"
        x-text="count + ' / {{ $maxlength }}'"
    ></span>
</div>
