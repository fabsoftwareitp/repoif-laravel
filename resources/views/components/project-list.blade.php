@props(["projects" => [], "showAuthor" => true])

<div class="project-list">
    <p class="project-list__published-total">
        {{ $projects->total() > 0 ? NumberFormatHelper::formatIntegerToShortForm($projects->total(), true) : "Nenhum" }}
        {{ in_array($projects->total(), [0, 1]) ? " projeto publicado" : " projetos publicados" }}
    </p>

    @if ($projects->count() > 0)
        <div class="project-list__card-grid">
            @foreach ($projects as $project)
                <article class="project-list__card">
                    <a
                        class="project-list__card-link"
                        href="{{ route('project.show', ['project' => $project->id]) }}"
                    ></a>
                    <div class="project-list__card-image-aspect-ratio-helper">
                        <div class="project-list__card-image-container">
                            @if ($project->type === 1)
                                <img
                                    class="project-list__card-thumbnail-icon"
                                    src="{{ asset('img/icons/document-project-thumbnail-icon.svg') }}"
                                    alt="Ícone de thumbnail de documento"
                                >
                            @elseif($project->type === 2)
                                <img
                                    class="project-list__card-image"
                                    src="{{ asset('storage/' . $project->path) }}"
                                    alt="Imagem do projeto"
                                >
                            @elseif($project->type === 3)
                                <img
                                    class="project-list__card-image"
                                    src="{{ ProjectHelper::getVideoProjectThumbnailUrl($project->url) }}"
                                    alt="Thumbnail do vídeo do projeto"
                                >
                            @elseif($project->type === 4)
                                <img
                                    class="project-list__card-thumbnail-icon"
                                    src="{{ asset('img/icons/web-project-thumbnail-icon.svg') }}"
                                    alt="Ícone de thumbnail de web"
                                >
                            @endif
                        </div>
                    </div>
                    <div class="project-list__card-content">
                        <h2 class="project-list__card-title ellipsis">{{ $project->title }}</h2>
                        <time
                            class="project-list__card-date"
                            pubdate
                            datetime="{{ $project->created_at->toDateString() }}"
                        >{{ $project->created_at->translatedFormat('d \d\e F \d\e Y') }}</time>

                        @if ($showAuthor)
                            <a
                                class="project-list__card-author"
                                href="{{ route('profile.show', ['user' => $project->user->id]) }}"
                            >
                                <div class="project-list__card-author-photo-container">
                                    @if ($project->user->photo_path)
                                        <img
                                            class="project-list__card-author-photo"
                                            src="{{ asset('storage/' . $project->user->photo_path) }}"
                                            alt="Foto do autor"
                                        >
                                    @else
                                        <img
                                            class="project-list__card-author-photo"
                                            src="{{ asset('img/icons/no-photo-icon.svg') }}"
                                            alt="Autor sem foto"
                                        >
                                    @endif
                                </div>
                                <div class="project-list__card-author-info">
                                    <span class="project-list__card-author-name ellipsis">{{ $project->user->name }}</span>
                                    <span class="project-list__card-author-projects-count ellipsis">
                                        {{ $project->user->projects_count > 0 ? NumberFormatHelper::formatIntegerToShortForm($project->user->projects_count, true) : "Nenhum" }}
                                        {{ in_array($project->user->projects_count, [0, 1]) ? " projeto publicado" : " projetos publicados" }}
                                    </span>
                                </div>
                            </a>
                        @endif
                    </div>
                    <div class="project-list__card-footer">
                        <div class="project-list__card-stats">
                            <div class="project-list__card-stats-info">
                                @php echo file_get_contents(public_path('img/icons/views-icon.svg')) @endphp
                                <span class="project-list__card-stats-info-data">{{ NumberFormatHelper::formatIntegerToShortForm($project->views) }}</span>
                            </div>
                            <div class="project-list__card-stats-info">
                                @php echo file_get_contents(public_path('img/icons/likes-icon.svg')) @endphp
                                <span class="project-list__card-stats-info-data">{{ NumberFormatHelper::formatIntegerToShortForm(0) }}</span>
                            </div>
                            <div class="project-list__card-stats-info">
                                @php echo file_get_contents(public_path('img/icons/comments-icon.svg')) @endphp
                                <span class="project-list__card-stats-info-data">{{ NumberFormatHelper::formatIntegerToShortForm(0) }}</span>
                            </div>
                        </div>
                        @if ($project->type === 1)
                            <img
                                class="project-list__card-project-type-icon"
                                src="{{ asset('img/icons/document-icon.svg') }}"
                                alt="Ícone de documento"
                            >
                        @elseif($project->type === 2)
                            <img
                                class="project-list__card-project-type-icon"
                                src="{{ asset('img/icons/image-icon.svg') }}"
                                alt="Ícone de imagem"
                            >
                        @elseif($project->type === 3)
                            <img
                                class="project-list__card-project-type-icon"
                                src="{{ asset('img/icons/video-icon.svg') }}"
                                alt="Ícone de vídeo"
                            >
                        @elseif($project->type === 4)
                            <img
                                class="project-list__card-project-type-icon"
                                src="{{ asset('img/icons/web-icon.svg') }}"
                                alt="Ícone de web"
                            >
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    @endif

    <x-pagination :paginator="$projects"></x-pagination>
</div>
