@props(["action", "method" => "POST", "enctype" => "", "title" => ""])

<form
    {{ $attributes->merge(["class" => "form"]) }}
    action="{{ $action }}"
    method="{{ $method === "GET" ? "GET" : "POST" }}"

    @if ($method === "POST" && $enctype === "multipart/form-data")
        enctype="{{ $enctype }}"
    @endif
>
    @if ($method !== "GET")
        @csrf
    @endif

    @if (!in_array($method, ["GET", "POST"]))
        @method($method)
    @endif

    @if ($title)
        <h1 class="form__title">{!! $title !!}</h1>
    @endif

    {{ $slot }}
</form>
