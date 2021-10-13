@props(['user'])

<div class="profile-card">
    <div class="profile-card__photo-container">
        @if ($user->photo_path)
            <img
                class="profile-card__photo"
                src="{{ asset('storage/' . $user->photo_path) }}"
                alt="Foto do usuário"
            >
        @else
            <img
                class="profile-card__photo"
                src="{{ asset('img/icons/no-photo-icon.svg') }}"
                alt="Usuário sem foto"
            >
        @endif
    </div>

    <div class="profile-card__info">
        <h1 class="profile-card__user-name">{{ $user->name }}</h1>

        <div class="profile-card__info-container">
            @php echo file_get_contents(public_path('img/icons/views-icon.svg')) @endphp
            <span class="profile-card__info-data">{{ number_format($user->profile_views, 0, ',', '.') }}</span>
        </div>

        <div class="profile-card__info-container profile-card__info-container--email">
            @php echo file_get_contents(public_path('img/icons/email-icon.svg')) @endphp
            <span class="profile-card__info-data profile-card__info-data--email">{{ $user->email }}</span>
        </div>

        @if ($user->description)
            <p class="profile-card__description">{{ $user->description }}</p>
        @endif

        @if (Auth::id() === $user->id)
            <div
                class="profile-card__actions"
                x-data="{ showModal: false }"
            >
                <x-button
                    type="link"
                    :href="route('profile.edit')"
                    text="Editar perfil"
                    :icon="asset('img/icons/edit-profile-icon.svg')"
                ></x-button>
                <x-button
                    class="button--outlined"
                    type="link"
                    :href="route('password.change')"
                    text="Alterar senha"
                    :svg="file_get_contents(public_path('img/icons/password-icon.svg'))"
                ></x-button>
                <x-button
                    class="button--outlined-red"
                    type="button"
                    text="Excluir conta"
                    :svg="file_get_contents(public_path('img/icons/delete-account-icon.svg'))"
                    onClick="showModal = true"
                ></x-button>

                <template x-if="showModal">
                    <x-modal
                        onButtonCloseClick="showModal = false"
                        message="Tudo vinculado a você será excluído do repositório (projetos, comentários, likes, dados cadastrais, etc.). Deseja mesmo excluir sua conta?"
                        buttonRoute="{{ route('profile.destroy') }}"
                    ></x-modal>
                </template>
            </div>
        @endif

        @if (session('status'))
            <p class="profile-card__status">{{ session('status') }}</p>
        @endif
    </div>
</div>
