<header class="header">
    <div class="container {{ Auth::check() ? 'header__container-user-logged' : 'header__container' }}">
        <div class="header__publish-container">
            <x-logo></x-logo>
            <x-button
                type="link"
                href="{{ route('project.create') }}"
                text="Publicar"
                :icon="asset('img/icons/publish-icon.svg')"
            ></x-button>
        </div>
        <x-input-search
            route="{{ route('project.index') }}"
            inputPlaceholder="Título, descrição ou autor"
            :displaySearch="! Route::is('profile.show')"
        ></x-input-search>
        <x-user-actions></x-user-actions>
    </div>
</header>
