<x-layout
    pageTitle="Login - RepoIF"
    pageDescription="Página de login do repositório para projetos de alunos do IFSP"
    pageOgTitle="Faça login no repoIF!"
    pageOgDescription="Se você é aluno do IFSP, faça login para publicar e interagir com projetos de outros alunos no repositório!"
    :pageOgImageUrl="asset('img/logos/logo-repoif-og.png')"
>
    <main class="container login">
        <x-presentation></x-presentation>
        <x-form
            action="{{ route('login') }}"
            title="Login"
        >
            @if (session('status'))
                <p class="login__message">{{ session('status') }}</p>
            @endif

            <x-form-group
                class="form-group--first"
                label="E-mail institucional"
                inputName="email"
                inputType="email"
                inputPlaceholder="usuario@aluno.ifsp.edu.br"
            ></x-form-group>

            <x-form-group
                label="Senha"
                inputName="password"
                inputType="password"
            ></x-form-group>

            <x-button
                class="button--full-width"
                text="Entrar"
                :icon="asset('img/icons/login-icon.svg')"
            ></x-button>

            <p class="form__info form__info--centered"><a class="form__info-link" href="{{ route('password.request') }}">Esqueci minha senha</a></p>
        </x-form>
    </main>
</x-layout>
