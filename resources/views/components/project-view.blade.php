@props(["project" => []])

<div class="project-view">
    <div class="project-view__media-aspect-ratio-helper">
        <div class="project-view__media-container"></div>
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
