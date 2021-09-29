<x-layout
    pageTitle="Alteração de senha - RepoIF"
    pageRobots="noindex, nofollow"
>
    <main class="container change-password">
        <x-form
            action="{{ route('password.change') }}"
            title="Alteração de senha"
        >
            <x-form-group
                class="form-group--first"
                label="Senha atual"
                inputName="current_password"
                inputType="password"
            ></x-form-group>

            <x-form-group
                label="Nova senha"
                inputName="new_password"
                inputType="password"
                inputPlaceholder="No mínimo 6 caracteres"
            ></x-form-group>

            <x-form-group
                label="Confirme a nova senha"
                inputName="new_password_confirmation"
                inputType="password"
            ></x-form-group>

            @if (session('status'))
                <p class="change-password__message">{{ session('status') }}</p>
            @endif

            <x-button
                class="button--full-width"
                text="Alterar senha"
                :icon="asset('img/icons/password-icon.svg')"
            ></x-button>
        </x-form>
    </main>
</x-layout>
