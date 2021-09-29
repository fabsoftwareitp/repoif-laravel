@props(["type" => "submit", "href" => "", "text", "icon"])

@if ($type === "submit")
    <button
        {{ $attributes->merge(["class" => "button"]) }}
        type="{{ $type }}"
    >
        <img src="{{ $icon }}" alt="">
        <span class="button__text">{{ $text }}</span>
    </button>
@elseif ($type === "link")
    <a
        {{ $attributes->merge(["class" => "button"]) }}
        href="{{ $href }}"
    >
        <img src="{{ $icon }}" alt="">
        <span class="button__text">{{ $text }}</span>
    </a>
@endif
