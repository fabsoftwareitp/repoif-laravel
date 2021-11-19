<x-layout
    pageTitle="Edição do projeto - RepoIF"
    pageRobots="noindex, nofollow"
>
    <main class="container project-edit">
        <x-form
            action="{{ route('project.update', ['project' => $project->id]) }}"
            enctype="multipart/form-data"
            title="Editar projeto"
        >
            <x-form-group
                component="text-area"
                label="Título"
                inputName="title"
                inputPlaceholder="Seja objetivo. Inclua palavras-chave para que seja chamativo e facilite a pesquisa por outros usuários."
                height="135"
                maxlength="100"
                inputValue="{{ $project->title }}"
            ></x-form-group>

            <x-form-group
                component="text-area"
                label="Descrição <span class='form-group__input-label-highlight'>(opcional)</span>"
                inputName="description"
                inputPlaceholder="Resuma o conteúdo do projeto, fornecendo mais detalhes, caso necessário. Inclua palavras-chave para facilitar a pesquisa por outros usuários."
                height="200"
                maxlength="1000"
                inputValue="{{ $project->description }}"
            ></x-form-group>

            @if ($project->type === 1)
                <x-form-group
                    component="input-file"
                    label="Arquivo"
                    inputName="file"
                    inputPlaceholder="Selecione o documento referente ao projeto."
                    accept=".pdf"
                    filename="{{ $project->file_name }}"
                ></x-form-group>

                <p class="form__info">
                    Extensões permitidas: <span class="form__info-highlight">.pdf</span><br>
                    Tamanho máximo: <span class="form__info-highlight">5 MB</span>
                </p>
            @elseif ($project->type === 2)
                <x-form-group
                    component="input-file"
                    label="Arquivo"
                    inputName="file"
                    inputPlaceholder="Selecione a imagem referente ao projeto."
                    accept=".png, .jpg, .jpge"
                    filename="{{ $project->file_name }}"
                ></x-form-group>

                <p class="form__info">
                    Extensões permitidas: <span class="form__info-highlight">.png, .jpg, .jpge</span><br>
                    Tamanho máximo: <span class="form__info-highlight">5 MB</span>
                </p>
            @elseif ($project->type === 3)
                <x-form-group
                    label="Link do vídeo no YouTube"
                    inputName="url"
                    inputPlaceholder="https://youtu.be/ye9kbLnpXEU"
                    inputValue="{{ $project->url }}"
                ></x-form-group>

                <p class="form__info">
                    Disponível na função <span class="form__info-highlight">'Compartilhar'</span> do YouTube.
                </p>
            @elseif ($project->type === 4)
                <div x-data="setSourceData()">
                    <x-form-group
                        component="select"
                        label="Origem do código-fonte"
                        inputName="source"
                        :options="[
                            1 => 'Arquivo compactado',
                            2 => 'GitHub'
                        ]"
                        onSelectChange="sourceType = $el.value"
                        inputValue="{{ $project->path_web ? 1 : 2 }}"
                    ></x-form-group>

                    <template x-if="sourceType === '1'">
                        <div>
                            <x-form-group
                                component="input-file"
                                label="Arquivo"
                                inputName="file"
                                inputPlaceholder="Selecione o arquivo referente ao projeto."
                                accept=".zip"
                                filename="{{ $project->file_name }}"
                            ></x-form-group>

                            <p class="form__info">
                                Extensões permitidas: <span class="form__info-highlight">.zip</span><br>
                                Tamanho máximo: <span class="form__info-highlight">5 MB</span><br>
                                Conteúdo suportado: <span class="form__info-highlight">Website estático (arquivos .html, .css, .js)</span><br>
                                Observação: <span class="form__info-highlight">Deve conter um arquivo index.html na raiz do arquivo compactado</span>
                            </p>
                        </div>
                    </template>

                    <template x-if="sourceType === '2'">
                        <div>
                            <x-form-group
                                label="Link do repositório no GitHub"
                                inputName="url"
                                inputPlaceholder="https://github.com/joao-silva/projeto-exemplo"
                                inputValue="{{ $project->url }}"
                            ></x-form-group>

                            <p class="form__info">
                                Conteúdo suportado: <span class="form__info-highlight">Website estático (arquivos .html, .css, .js)</span><br>
                                Observação: <span class="form__info-highlight">Deve conter um arquivo index.html na raiz do código-fonte do repositório</span>
                            </p>
                        </div>
                    </template>
                </div>
            @endif

            <x-button
                class="button--full-width"
                text="Editar"
                :icon="asset('img/icons/edit-project-icon.svg')"
            ></x-button>
        </x-form>
    </main>

    @once
        @push("additional")
            <script>
                function setSourceData() {
                    const sourceSelect = document.querySelector("#source");
                    return { sourceType: sourceSelect.value || '1' };
                }
            </script>
        @endpush
    @endonce

</x-layout>
