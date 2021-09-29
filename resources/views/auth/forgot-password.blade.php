<x-layout
    pageTitle="Recuperação de senha - RepoIF"
    pageRobots="noindex, nofollow"
>
    <main class="container forgot-password">
        <x-form
            action="{{ route('password.email') }}"
            title="Recuperação de senha"
        >
            <p class="forgot-password__text">Esqueceu a sua senha? Sem problemas. Informe o seu e-mail institucional e enviaremos um link de recuperação para ele, para que você possa definir uma nova senha.</p>

            <x-form-group
                label="E-mail institucional"
                inputName="email"
                inputType="email"
                inputPlaceholder="usuario@aluno.ifsp.edu.br"
            ></x-form-group>

            @if (session('status'))
                <p class="forgot-password__message">{{ session('status') }}</p>
            @endif

            <x-button
                class="button--full-width"
                text="Enviar"
                :icon="asset('img/icons/email-icon.svg')"
            ></x-button>
        </x-form>
    </main>
</x-layout>
