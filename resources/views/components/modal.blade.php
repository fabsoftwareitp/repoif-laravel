@props(["onButtonCloseClick"])

<div
    class="modal"
    @click.self="{{ $onButtonCloseClick }}"
>
    <div class="modal__container">
        <button
            class="modal__close-button"
            type="button"
            @click="{{ $onButtonCloseClick }}"
        >
            <img src="{{ asset('img/icons/close-icon.svg') }}" alt="Ícone de fechar modal">
        </button>

        {{ $slot }}
    </div>
</div>
