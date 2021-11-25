<x-layout
    pageTitle="Publicar projeto - RepoIF"
    pageDescription="Página de publicação de projeto do aluno no RepoIF"
    pageOgTitle="Publique um projeto seu no RepoIF!"
    pageOgDescription="Se você é aluno do IFSP, publique seus projetos no RepoIF para colaborar com a preservação da memória da instituição e de seus alunos!"
    :pageOgImageUrl="asset('img/logos/logo-repoif-og.png')"
>
    <main
        class="container project-create"
        x-data="setProjectData()"
    >
        <x-form
            action="{{ route('project.store') }}"
            enctype="multipart/form-data"
            title="Publicar projeto"
        >
            <x-form-group
                component="text-area"
                label="Título"
                inputName="title"
                inputPlaceholder="Seja objetivo. Inclua palavras-chave para que seja chamativo e facilite a pesquisa por outros usuários."
                height="135"
                maxlength="100"
            ></x-form-group>

            <x-form-group
                component="text-area"
                label="Descrição <span class='form-group__input-label-highlight'>(opcional)</span>"
                inputName="description"
                inputPlaceholder="Resuma o conteúdo do projeto, fornecendo mais detalhes, caso necessário. Inclua palavras-chave para facilitar a pesquisa por outros usuários."
                height="200"
                maxlength="1000"
            ></x-form-group>

            <x-form-group
                component="select"
                label="Tipo de projeto"
                inputName="type"
                :options="[
                    1 => 'Documento',
                    2 => 'Imagem',
                    3 => 'Vídeo',
                    4 => 'Projeto web'
                ]"
                onSelectChange="projectType = $el.value"
            ></x-form-group>

            <template x-if="projectType === '1'">
                <div>
                    <x-form-group
                        component="input-file"
                        label="Arquivo"
                        inputName="file"
                        inputPlaceholder="Selecione o documento referente ao projeto."
                        accept=".pdf"
                    ></x-form-group>

                    <p class="form__info">
                        Extensões permitidas: <span class="form__info-highlight">.pdf</span><br>
                        Tamanho máximo: <span class="form__info-highlight">5 MB</span>
                    </p>
                </div>
            </template>

            <template x-if="projectType === '2'">
                <div>
                    <x-form-group
                        component="input-file"
                        label="Arquivo"
                        inputName="file"
                        inputPlaceholder="Selecione a imagem referente ao projeto."
                        accept=".png, .jpg, .jpeg"
                    ></x-form-group>

                    <p class="form__info">
                        Extensões permitidas: <span class="form__info-highlight">.png, .jpg, .jpeg</span><br>
                        Tamanho máximo: <span class="form__info-highlight">5 MB</span>
                    </p>
                </div>
            </template>

            <template x-if="projectType === '3'">
                <div>
                    <x-form-group
                        label="Link do vídeo no YouTube"
                        inputName="url"
                        inputPlaceholder="https://youtu.be/ye9kbLnpXEU"
                    ></x-form-group>

                    <p class="form__info">
                        Disponível na função <span class="form__info-highlight">'Compartilhar'</span> do YouTube.
                    </p>
                </div>
            </template>

            <template x-if="projectType === '4'">
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
                    ></x-form-group>

                    <template x-if="sourceType === '1'">
                        <div>
                            <x-form-group
                                component="input-file"
                                label="Arquivo"
                                inputName="file"
                                inputPlaceholder="Selecione o arquivo referente ao projeto."
                                accept=".zip"
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
                            ></x-form-group>

                            <p class="form__info">
                                Conteúdo suportado: <span class="form__info-highlight">Website estático (arquivos .html, .css, .js)</span><br>
                                Observação: <span class="form__info-highlight">Deve conter um arquivo index.html na raiz do código-fonte do repositório</span>
                            </p>
                        </div>
                    </template>
                </div>
            </template>

            <x-button
                class="button--full-width"
                text="Publicar"
                :icon="asset('img/icons/publish-icon.svg')"
            ></x-button>
        </x-form>
    </main>

    @once
        @push("additional")
            <script>
                function setProjectData() {
                    const typeSelect = document.querySelector("#type");
                    return { projectType: typeSelect.value || '1' };
                }

                function setSourceData() {
                    const sourceSelect = document.querySelector("#source");
                    return { sourceType: sourceSelect.value || '1' };
                }
            </script>
        @endpush
    @endonce

</x-layout>
