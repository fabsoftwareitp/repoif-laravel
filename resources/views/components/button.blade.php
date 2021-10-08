@props(["type" => "submit", "href" => "", "text", "icon", "svg" => "", "onClick" => ""])

@if ($type === "submit")
    <button
        {{ $attributes->merge(["class" => "button"]) }}
        type="{{ $type }}"
    >
        @if ($svg)
            @php echo $svg; @endphp
        @else
            <img src="{{ $icon }}" alt="">
        @endif
        <span class="button__text">{{ $text }}</span>
    </button>
@elseif ($type === "link")
    <a
        {{ $attributes->merge(["class" => "button"]) }}
        href="{{ $href }}"
    >
        @if ($svg)
            @php echo $svg; @endphp
        @else
            <img src="{{ $icon }}" alt="">
        @endif
        <span class="button__text">{{ $text }}</span>
    </a>
@elseif ($type === "button")
    <button
        {{ $attributes->merge(["class" => "button"]) }}
        type="{{ $type }}"

        @if ($onClick)
            @click="{{ $onClick }}"
        @endif
    >
        @if ($svg)
            @php echo $svg; @endphp
        @else
            <img src="{{ $icon }}" alt="">
        @endif
        <span class="button__text">{{ $text }}</span>
    </button>
@endif
