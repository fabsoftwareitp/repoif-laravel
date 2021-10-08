<header class="header">
    <div class="container header__container">
        <div class="header__publish-container">
            <x-logo></x-logo>
            <x-button
                type="link"
                href="#"
                text="Publicar"
                :icon="asset('img/icons/publish-icon.svg')"
            ></x-button>
        </div>
        <x-main-search></x-main-search>
        <x-user-actions></x-user-actions>
    </div>
</header>
