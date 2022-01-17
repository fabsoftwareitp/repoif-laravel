@props(["class" => "", "route" => "", "inputPlaceholder" => "", "displaySearch" => true])

@php
    $queryStringsToInclude = [
        'tipo_projeto',
        'classificacao',
        'ordenacao',
        'data_inicial',
        'data_final'
    ];
@endphp

<div class="input-search">
    <x-form
        class="form--no-style input-search__input-container {{ $class }}"
        action="{{ $route }}"
        method="GET"
    >
        @foreach ($queryStringsToInclude as $queryString)
            @if (Request::query($queryString, ''))
                <input type="hidden" name="{{ $queryString }}" value="{{ Request::query($queryString, '') }}">
            @endif
        @endforeach

        <input
            class="input-search__input"
            name="pesquisa"
            value="{{ $displaySearch ? Request::query('pesquisa', '') : '' }}"
            placeholder="{{ $inputPlaceholder }}"
        >

        <button
            class="input-search__button"
            type="submit"
        >
            <img src="{{ asset('img/icons/search-icon.svg') }}" alt="Pesquisar">
        </button>
    </x-form>
</div>
