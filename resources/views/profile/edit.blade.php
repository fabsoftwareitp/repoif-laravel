<x-layout
    pageTitle="Edição do perfil - RepoIF"
    pageRobots="noindex, nofollow"
>
    <main class="container profile-edit">
        <x-form
            action="{{ route('profile.update') }}"
            enctype="multipart/form-data"
            title="Edição do perfil"
        >
            <x-image-input
                :imageUrl="$user->photo_path ? asset('storage/' . $user->photo_path) : null"
            ></x-image-input>

            <x-form-group
                label="Nome"
                inputName="name"
                inputPlaceholder="Nome completo"
                inputValue="{{ $user->name }}"
            ></x-form-group>

            <x-form-group
                label="E-mail institucional"
                inputName="email"
                inputType="email"
                inputPlaceholder="usuario@aluno.ifsp.edu.br"
                inputValue="{{ $user->email }}"
            ></x-form-group>

            <x-form-group
                component="text-area"
                label="Descrição"
                inputName="description"
                inputPlaceholder="Curso, câmpus, local de trabalho, atividades, características, preferências, etc."
                height="172"
                maxlength="200"
                inputValue="{{ $user->description }}"
            ></x-form-group>

            <x-button
                class="button--full-width"
                text="Editar"
                :icon="asset('img/icons/edit-profile-icon.svg')"
            ></x-button>
        </x-form>
    </main>
</x-layout>
