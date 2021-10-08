<div class="main-search">
    <x-form
        class="form--no-style main-search__input-container"
        action="#"
        method="GET"
    >
        <input
            class="main-search__input"
            name="pesquisa"
            value="{{ request('pesquisa', '') }}"
            placeholder="Título, descrição ou autor"
        >
        <button
            class="main-search__button"
            type="submit"
        >
            <img src="{{ asset('img/icons/search-icon.svg') }}" alt="Pesquisar">
        </button>
    </x-form>
</div>
