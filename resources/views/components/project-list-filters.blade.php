@props(["route" => ""])

@php
    $showModal = $errors->hasAny([
        'tipo_projeto',
        'classificacao',
        'ordenacao',
        'data_inicial',
        'data_final'
    ]) ? 'true' : 'false';
@endphp

<div
    class="project-list-filters"
    x-data="{ showModal: {{ $showModal }} }"
>
    <x-button
        class="button--outlined"
        type="button"
        text="Filtros"
        :svg="file_get_contents(public_path('img/icons/filter-icon.svg'))"
        onClick="showModal = true"
    ></x-button>

    <div
        x-cloak
        x-show="showModal"
    >
        <x-modal onButtonCloseClick="showModal = false">
            <x-form
                class="form--no-style"
                method="GET"
                action="{{ $route }}"
            >
                <x-form-group
                    component="select"
                    label="Tipo de projeto"
                    inputName="tipo_projeto"
                    :options="[
                        'todos' => 'Todos',
                        'documentos' => 'Documentos',
                        'imagens' => 'Imagens',
                        'videos' => 'Vídeos',
                        'projetos-web' => 'Projetos web'
                    ]"
                    inputValue="{{ Request::query('tipo_projeto') ?: 'todos' }}"
                ></x-form-group>

                <x-form-group
                    component="select"
                    label="Classificação"
                    inputName="classificacao"
                    :options="[
                        'nenhuma' => 'Nenhuma',
                        'mais-visualizados' => 'Mais visualizados',
                        'mais-avaliados' => 'Mais avaliados',
                    ]"
                    inputValue="{{ Request::query('classificacao') ?: 'nenhuma' }}"
                ></x-form-group>

                <x-form-group
                    component="select"
                    label="Ordenação"
                    inputName="ordenacao"
                    :options="[
                        'mais-recentes' => 'Mais recentes',
                        'mais-antigos' => 'Mais antigos',
                    ]"
                    inputValue="{{ Request::query('ordenacao') ?: 'mais-recentes' }}"
                ></x-form-group>

                <x-form-group
                    label="Período"
                    inputName="data_inicial"
                    inputPlaceholder="dd/mm/aaaa"
                    inputValue="{{ Request::query('data_inicial') ?: '' }}"
                ></x-form-group>

                <p class="project-list-filters__between-period-text">à</p>

                <x-form-group
                    class="form-group--first"
                    inputName="data_final"
                    inputPlaceholder="dd/mm/aaaa"
                    inputValue="{{ Request::query('data_final') ?: '' }}"
                ></x-form-group>

                <x-button
                    class="button--full-width"
                    text="Filtrar"
                    :svg="file_get_contents(public_path('img/icons/filter-icon.svg'))"
                ></x-button>
            </x-form>
        </x-modal>
    </div>
</div>

@once
    @push("additional")
        <script defer src="https://unpkg.com/vanilla-masker@1.1.1/build/vanilla-masker.min.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                const initialDate = document.querySelector("#data_inicial");
                const finalDate = document.querySelector("#data_final");

                initialDate.setAttribute("inputmode", "numeric");
                finalDate.setAttribute("inputmode", "numeric");

                const dateMask = "99/99/9999";
                VMasker(initialDate).maskPattern(dateMask);
                VMasker(finalDate).maskPattern(dateMask);
            });
        </script>
    @endpush
@endonce
