@props(["action", "method" => "POST", "title" => ""])

<form
    {{ $attributes->merge(["class" => "form"]) }}
    action="{{ $action }}"
    method="{{ $method === "GET" ? "GET" : "POST" }}"
>
    @if ($method !== "GET")
        @csrf
    @endif

    @if (!in_array($method, ["GET", "POST"]))
        @method($method)
    @endif

    @if ($title)
        <h1 class="form__title">{{ $title }}</h1>
    @endif

    {{ $slot }}
</form>
