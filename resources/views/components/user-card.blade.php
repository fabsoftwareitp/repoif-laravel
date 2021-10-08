<div
    class="user-card"
    x-data="{ showMenu: false }"
>
    <div
        class="user-card__user"
        :class="showMenu && 'user-card__user--active'"
        @click="showMenu = ! showMenu"
    >
        <div class="user-card__photo-container">
            @if (Auth::user()->photo_path)
                <img
                    class="user-card__photo"
                    src="{{ asset('storage/' . Auth::user()->photo_path) }}"
                    alt="Foto do usuário"
                >
            @else
                <img
                    class="user-card__photo"
                    src="{{ asset('img/icons/no-photo-icon.svg') }}"
                    alt="Usuário sem foto"
                >
            @endif
        </div>
        <span class="user-card__name">{{ explode(' ', Auth::user()->name)[0] }}</span>
    </div>

    <div
        class="user-card__menu"
        x-show="showMenu"
        @click.outside="showMenu = false"
    >
        <div class="user-card__menu-container">
            <a
                class="user-card__menu-item"
                href="{{ route('profile.show', ['user' => Auth::id()]) }}"
            >
                <img
                    class="user-card__menu-item-image"
                    src="{{ asset('img/icons/no-photo-icon.svg') }}"
                    alt=""
                >
                <span class="user-card__menu-item-text">Meu perfil</span>
            </a>

            <x-form
                class="form--no-style"
                action="{{ route('logout') }}"
            >
                <button
                    class="user-card__menu-item"
                    type="submit"
                >
                    <img
                        class="user-card__menu-item-image"
                        src="{{ asset('img/icons/logout-icon.svg') }}"
                        alt=""
                    >
                    <span class="user-card__menu-item-text">Sair</span>
                </button>
            </x-form>
        </div>
    </div>
</div>
