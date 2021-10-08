@props(["message", "buttonRoute", "onButtonCloseClick"])

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
            <img src="{{ asset('img/icons/close-icon.svg') }}" alt="">
        </button>

        <p class="modal__message">{{ $message }}</p>

        <x-form
            class="form--no-style"
            action="{{ $buttonRoute }}"
        >
            <x-button
                class="button--red button--full-width"
                text="Excluir conta"
                :svg="file_get_contents(public_path('img/icons/delete-account-icon.svg'))"
            ></x-button>
        </x-form>
    </div>
</div>
