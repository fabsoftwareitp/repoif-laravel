<x-layout
    pageTitle="Cadastro - RepoIF"
    pageDescription="Página de cadastro do repositório para projetos de alunos do IFSP"
    pageOgTitle="Cadastre-se no repoIF!"
    pageOgDescription="Se você é aluno do IFSP, cadastre-se para publicar e interagir com projetos de outros alunos no repositório!"
    :pageOgImageUrl="asset('img/logos/logo-repoif-og.png')"
>
    <main class="container register">
        <x-presentation></x-presentation>
        <x-form
            action="{{ route('register') }}"
            title="Cadastro"
        >
            <x-form-group
                class="form-group--first"
                label="Nome"
                inputName="name"
                inputPlaceholder="Nome completo"
            ></x-form-group>

            <x-form-group
                label="E-mail institucional"
                inputName="email"
                inputType="email"
                inputPlaceholder="usuario@aluno.ifsp.edu.br"
            ></x-form-group>

            <x-form-group
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
                text="Cadastrar"
                :icon="asset('img/icons/register-icon.svg')"
            ></x-button>

            <p class="form__info">Ao se cadastrar, você concorda com os <span class="form__info-highlight"><a class="form__info-link" href="#">Termos de uso</a></span> e com a <span class="form__info-highlight"><a class="form__info-link" href="#">Política de privacidade</a></span> do repositório.</p>
        </x-form>
    </main>
</x-layout>
