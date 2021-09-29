<x-layout
    pageTitle="Redefinição de senha - RepoIF"
    pageRobots="noindex, nofollow"
>
    <main class="container reset-password">
        <x-form
            action="{{ route('password.update') }}"
            title="Redefinição de senha"
        >
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ $request->email }}">

            <x-form-group
                class="form-group--first"
                label="Senha"
                inputName="password"
                inputType="password"
                inputPlaceholder="No mínimo 6 caracteres"
            ></x-form-group>

            <x-form-group
                label="Confirme a sua senha"
                inputName="password_confirmation"
                inputType="password"
            ></x-form-group>

            <x-button
                class="button--full-width"
                text="Redefinir senha"
                :icon="asset('img/icons/password-icon.svg')"
            ></x-button>
        </x-form>
    </main>
</x-layout>
