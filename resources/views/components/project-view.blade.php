@props(["project" => [], "userLikedProject" => false])

<div class="project-view">
    <div class="project-view__media-aspect-ratio-helper">
        <div class="project-view__media-container {{ $project->type === 4 ? 'project-view__media-container--web' : '' }}">
            @if ($project->type === 1)
                <object
                    class="project-view__media-object"
                    data="{{ asset('storage/' . $project->path) }}"
                    type="application/pdf"
                >
                    <div class="project-view__media-object-fallback">
                        <img
                            class="project-view__media-object-fallback-image"
                            src="{{ asset('img/icons/document-project-thumbnail-icon.svg') }}"
                            alt="Ícone de thumbnail de documento"
                        >
                    </div>
                </object>
                <a
                    class="project-view__media-link project-view__media-link--hide"
                    href="{{ asset('storage/' . $project->path) }}"
                    target="_blank"
                >
                    <img src="{{ asset('img/icons/external-link-icon.svg') }}" alt="Abrir em outra aba">
                </a>
            @elseif ($project->type === 2)
                <img
                    class="project-view__media-image"
                    src="{{ asset('storage/' . $project->path) }}"
                    alt="Imagem do projeto"
                >
                <a
                    class="project-view__media-link"
                    href="{{ asset('storage/' . $project->path) }}"
                    target="_blank"
                >
                    <img src="{{ asset('img/icons/external-link-icon.svg') }}" alt="Abrir em outra aba">
                </a>
            @elseif ($project->type === 3)
                <iframe
                    class="project-view__media-iframe"
                    src="{{ ProjectHelper::getVideoProjectEmbeddedUrl($project->url) }}"
                    title="YouTube video player"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen
                ></iframe>
            @elseif ($project->type === 4)
                @if ($project->path_web)
                    <iframe
                        class="project-view__media-iframe"
                        src="{{ asset('storage/' . $project->path_web) . '/index.html' }}"
                        title="Visualizador do projeto web"
                        frameborder="0"
                    ></iframe>
                    <a
                        class="project-view__media-link"
                        href="{{ asset('storage/' . $project->path_web) . '/index.html' }}"
                        target="_blank"
                    >
                        <img src="{{ asset('img/icons/external-link-icon.svg') }}" alt="Abrir em outra aba">
                    </a>
                @else
                    <iframe
                        class="project-view__media-iframe"
                        src="{{ ProjectHelper::getGitHubProjectEmbeddedUrl($project->url) }}"
                        title="Visualizador do projeto web"
                        frameborder="0"
                    ></iframe>
                    <a
                        class="project-view__media-link"
                        href="{{ ProjectHelper::getGitHubProjectEmbeddedUrl($project->url) }}"
                        target="_blank"
                    >
                        <img src="{{ asset('img/icons/external-link-icon.svg') }}" alt="Abrir em outra aba">
                    </a>
                @endif
            @endif
        </div>
    </div>

    <div class="project-view__header">
        <h1 class="project-view__title">{{ $project->title }}</h1>

        <div class="project-view__details">
            <div class="project-view__date-container">
                <time
                    class="project-view__date"
                    pubdate
                    datetime="{{ $project->created_at->toDateString() }}"
                >{{ $project->created_at->translatedFormat('d \d\e F \d\e Y') }}</time>
            </div>

            <div class="project-view__views-type-container">
                <div class="project-view__views-container">
                    @php echo file_get_contents(public_path('img/icons/views-icon.svg')) @endphp
                    <span class="project-view__views">{{ NumberFormatHelper::formatIntegerToShortForm($project->views) }}</span>
                </div>

                @if ($project->type === 1)
                    <img
                        class="project-view__type-icon"
                        src="{{ asset('img/icons/document-icon.svg') }}"
                        alt="Ícone de documento"
                    >
                @elseif($project->type === 2)
                    <img
                        class="project-view__type-icon"
                        src="{{ asset('img/icons/image-icon.svg') }}"
                        alt="Ícone de imagem"
                    >
                @elseif($project->type === 3)
                    <img
                        class="project-view__type-icon"
                        src="{{ asset('img/icons/video-icon.svg') }}"
                        alt="Ícone de vídeo"
                    >
                @elseif($project->type === 4)
                    <img
                        class="project-view__type-icon"
                        src="{{ asset('img/icons/web-icon.svg') }}"
                        alt="Ícone de web"
                    >
                @endif
            </div>
        </div>
    </div>

    <div class="project-view__author-actions">
        <a
            class="project-view__author"
            href="{{ route('profile.show', ['user' => $project->user->id]) }}"
        >
            <div class="project-view__author-photo-container">
                @if ($project->user->photo_path)
                    <img
                        class="project-view__author-photo"
                        src="{{ asset('storage/' . $project->user->photo_path) }}"
                        alt="Foto do autor"
                    >
                @else
                    <img
                        class="project-view__author-photo"
                        src="{{ asset('img/icons/no-photo-icon.svg') }}"
                        alt="Autor sem foto"
                    >
                @endif
            </div>
            <div class="project-view__author-info">
                <span class="project-view__author-name ellipsis">{{ $project->user->name }}</span>
                <span class="project-view__author-projects-count ellipsis">
                    {{ NumberFormatHelper::formatIntegerToShortForm($project->user->projects_count, true) }}
                    {{ $project->user->projects_count === 1 ? " projeto publicado" : " projetos publicados" }}
                </span>
            </div>
        </a>

        <div
            class="project-view__actions"
            x-data="{ showModal: false }"
        >
            <div class="project-view__actions-container">
                <x-form
                    class="form--no-style"
                    action="{{ route('project.like', ['project' => $project->id]) }}"
                >
                    <x-button
                        class="{{ $userLikedProject ? '' : 'button--outlined' }}"
                        text="{{ $project->likes_count }}"
                        :svg="file_get_contents(public_path('img/icons/likes-icon.svg'))"
                    ></x-button>
                </x-form>

                @if ($project->type !== 3)
                    @php
                        $downloadLink = $project->path
                            ? asset("storage/" . $project->path)
                            : $project->url . "/archive/refs/heads/master.zip";
                    @endphp

                    <x-button
                        class="button--outlined"
                        type="link"
                        download="{{ $project->file_name ?: '' }}"
                        :href="$downloadLink"
                        text="Download"
                        :svg="file_get_contents(public_path('img/icons/download-icon.svg'))"
                    ></x-button>
                @endif

                @if (Auth::id() === $project->user->id)
                    <x-button
                        class="button--outlined"
                        type="link"
                        :href="route('project.edit', ['project' => $project->id])"
                        text="Editar"
                        :svg="file_get_contents(public_path('img/icons/edit-project-icon.svg'))"
                    ></x-button>
                    <x-button
                        class="button--outlined-red"
                        type="button"
                        text="Excluir"
                        :svg="file_get_contents(public_path('img/icons/trash-icon.svg'))"
                        onClick="showModal = true"
                    ></x-button>
                @endif
            </div>

            <div
                x-cloak
                x-show="showModal"
            >
                <x-modal onButtonCloseClick="showModal = false">
                    <p class="project-view__delete-project-message">Deseja mesmo excluir seu projeto?</p>

                    <x-form
                        class="form--no-style"
                        action="{{ route('project.destroy', ['project' => $project->id]) }}"
                        method="DELETE"
                    >
                        <x-button
                            class="button--red button--full-width"
                            text="Excluir projeto"
                            :svg="file_get_contents(public_path('img/icons/trash-icon.svg'))"
                        ></x-button>
                    </x-form>
                </x-modal>
            </div>
        </div>
    </div>

    @if ($project->description)
        <div class="project-view__description-container">
            <p
                id="project-view-description"
                class="project-view__description read-limited"
            >{{ $project->description }}</p>
            <button
                class="project-view__description-read-button read-button"
                data-read-element="project-view-description"
                data-show-text="Ler mais"
                data-hide-text="Ler menos"
            ></button>
        </div>
    @endif
</div>

@if ($project->type === 1)
    @once
        @push("additional")
            <script>
                document.addEventListener("DOMContentLoaded", () => {
                    const objectFallback = document.querySelector(".project-view__media-object-fallback");

                    if (objectFallback.clientHeight === 0) {
                        const mediaLink = document.querySelector(".project-view__media-link");

                        mediaLink.classList.remove("project-view__media-link--hide");
                    }
                });
            </script>
        @endpush
    @endonce
@endif
