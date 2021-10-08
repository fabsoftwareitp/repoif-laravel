<x-layout
    pageTitle="Completar cadastro - RepoIF"
    pageRobots="noindex, nofollow"
>
    <main class="container profile-complete">
        <x-form
            action="{{ route('profile.complete') }}"
            enctype="multipart/form-data"
            title="Complete o seu perfil <span class='form__title-highlight'>(opcional)</span>"
        >
            <x-image-input></x-image-input>

            <x-form-group
                component="text-area"
                label="Descrição"
                inputName="description"
                inputPlaceholder="Curso, câmpus, local de trabalho, atividades, características, preferências, etc."
                height="172"
                maxlength="200"
            ></x-form-group>

            <x-button
                class="button--full-width"
                text="Concluir"
                :icon="asset('img/icons/check-icon.svg')"
            ></x-button>

            <p class="form__info">Você poderá editar posteriormente estes e os demais dados no <span class="form__info-highlight">seu perfil,</span> clicando em <span class="form__info-highlight">Editar perfil.</span></p>
        </x-form>
    </main>
</x-layout>
