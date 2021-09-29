@props(["type"])

@if ($type === "password")
    <div
        class="input-container"
        x-data="{ visible: false }"
    >
        <input
            {{ $attributes->merge(["class" => "input"]) }}
            :type="visible ? 'text' : 'password'"
        >
        <button @click="visible = !visible" type="button" class="password-eye-btn">
            <img
                :src="visible ? '/img/icons/password-eye-hide.svg' : '/img/icons/password-eye-see.svg'")
                alt=""
            >
        </button>
    </div>
@else
    <div class="input-container">
        <input
            {{ $attributes->merge(["class" => "input"]) }}
            type="{{ $type }}"
        >
    </div>
@endif
