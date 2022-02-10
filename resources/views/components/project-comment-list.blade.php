@props(["project" => [], "comments" => []])

<div
    id="comentarios"
    class="project-comment-list"
>
    <div class="project-comment-list__header">
        @php echo file_get_contents(public_path('img/icons/comments-icon.svg')) @endphp
        <span class="project-comment-list__header-text">Comentários</span>
        <span class="project-comment-list__published-total">{{ NumberFormatHelper::formatIntegerToShortForm($comments->total()) }}</span>
    </div>

    <div class="project-comment-list__new-comment">
        <div class="project-comment-list__user-photo-container">
            @if (Auth::check() && Auth::user()->photo_path)
                <img
                    class="project-comment-list__user-photo"
                    src="{{ asset('storage/' . Auth::user()->photo_path) }}"
                    alt="Foto do usuário"
                >
            @else
                <img
                    class="project-comment-list__user-photo"
                    src="{{ asset('img/icons/no-photo-icon.svg') }}"
                    alt="Usuário sem foto"
                >
            @endif
        </div>

        <x-form
            class="form--no-style"
            action="{{ route('project-comment.create', ['project' => $project->id]) }}"
        >
            <x-form-group
                class="form-group--first"
                component="text-area"
                inputName="comment"
                inputPlaceholder="Publique um comentário relacionado ao projeto."
                height="200"
                maxlength="1000"
            ></x-form-group>

            <x-button
                text="Publicar"
                :icon="asset('img/icons/publish-comment-icon.svg')"
            ></x-button>
        </x-form>
    </div>

    @foreach ($comments as $comment)
        <article
            id="comentario-{{ $comment->id }}"
            class="project-comment-list__comment"
        >
            <a
                class="project-comment-list__comment-header"
                href="{{ route('profile.show', ['user' => $comment->user->id]) }}"
            >
                <div class="project-comment-list__comment-author-photo-container">
                    @if ($comment->user->photo_path)
                        <img
                            class="project-comment-list__comment-author-photo"
                            src="{{ asset('storage/' . $comment->user->photo_path) }}"
                            alt="Foto do autor do comentário"
                        >
                    @else
                        <img
                            class="project-comment-list__comment-author-photo"
                            src="{{ asset('img/icons/no-photo-icon.svg') }}"
                            alt="Autor do comentário sem foto"
                        >
                    @endif
                </div>

                <div class="project-comment-list__comment-info">
                    <span class="project-comment-list__comment-author-name ellipsis">{{ $comment->user->name }}</span>
                    <time
                        class="project-comment-list__comment-datetime"
                        pubdate
                        datetime="{{ $comment->created_at->toDateTimeString() }}"
                    >
                        <div class="project-comment-list__comment-date-container">
                            <span class="project-comment-list__comment-date">{{ $comment->created_at->translatedFormat('d \d\e F \d\e Y') }}</span>
                        </div>
                        <span class="project-comment-list__comment-time">{{ $comment->created_at->translatedFormat('H:i') }}</span>
                    </time>
                </div>
            </a>

            <div class="project-comment-list__comment-content-container">
                <p
                    id="project-comment-list-comment-{{ $comment->id }}-content"
                    class="project-comment-list__comment-content read-limited"
                >
                    @if ($comment->related_user)
                        <a
                            class="project-comment-list__comment-content-related-user"
                            href="{{ route('profile.show', ['user' => $comment->related_user->id]) }}"
                        >{{ '@' . $comment->related_user->name }}</a>{{ $comment->content }}
                    @else
                        {{ $comment->content }}
                    @endif
                </p>
                <button
                    class="project-comment-list__comment-content-read-button read-button"
                    data-read-element="project-comment-list-comment-{{ $comment->id }}-content"
                    data-show-text="Ler mais"
                    data-hide-text="Ler menos"
                ></button>
            </div>

            <div
                class="project-comment-list__actions"
                x-data="{ showReplyModal: false, showEditModal: false, showDeleteModal: false }"
            >
                <div class="project-comment-list__actions-container">
                    <x-form
                        class="form--no-style"
                        action="{{ route('project-comment.like', ['project' => $project->id, 'projectComment' => $comment->id]) }}"
                    >
                        <x-button
                            class="{{ $comment->current_user_liked->isNotEmpty() ? '' : 'button--outlined' }}"
                            text="{{ $comment->likes_count }}"
                            :svg="file_get_contents(public_path('img/icons/likes-icon.svg'))"
                        ></x-button>
                    </x-form>

                    <x-button
                        class="button--outlined"
                        type="button"
                        text="Responder"
                        :svg="file_get_contents(public_path('img/icons/reply-icon.svg'))"
                        onClick="showReplyModal = true"
                    ></x-button>

                    @if (Auth::id() === $comment->user->id)
                        <x-button
                            class="button--outlined"
                            type="button"
                            text="Editar"
                            :svg="file_get_contents(public_path('img/icons/edit-project-icon.svg'))"
                            onClick="showEditModal = true"
                        ></x-button>

                        <x-button
                            class="button--outlined-red"
                            type="button"
                            text="Excluir"
                            :svg="file_get_contents(public_path('img/icons/trash-icon.svg'))"
                            onClick="showDeleteModal = true"
                        ></x-button>
                    @endif
                </div>

                <div
                    class="project-comment-list__modal-comment"
                    x-cloak
                    x-show="showReplyModal"
                >
                    <x-modal onButtonCloseClick="showReplyModal = false">
                        <x-form
                            class="form--no-style"
                            action="{{ route('project-comment.create', ['project' => $project->id]) }}"
                        >
                            <input type="hidden" name="related_user" value="{{ $comment->user->id }}">

                            <p class="project-comment-list__modal-text">
                                Respondendo ao comentário de
                                <a
                                    class="project-comment-list__modal-link"
                                    href="{{ route('profile.show', ['user' => $comment->user->id]) }}"
                                >{{ '@' . $comment->user->name }}</a>
                            </p>

                            <x-form-group
                                class="form-group--first"
                                component="text-area"
                                inputName="comment"
                                inputPlaceholder="Publique uma resposta ao comentário."
                                height="200"
                                maxlength="1000"
                            ></x-form-group>

                            <x-button
                                class="button--full-width"
                                text="Responder comentário"
                                :svg="file_get_contents(public_path('img/icons/reply-icon.svg'))"
                            ></x-button>
                        </x-form>
                    </x-modal>
                </div>

                <div
                    class="project-comment-list__modal-comment"
                    x-cloak
                    x-show="showEditModal"
                >
                    <x-modal onButtonCloseClick="showEditModal = false">
                        <div class="project-comment-list__form-edit-comment">
                            <x-form
                                class="form--no-style"
                                title="Edição do comentário"
                                action="{{ route('project-comment.update', ['project' => $project->id, 'projectComment' => $comment->id]) }}"
                                method="PUT"
                            >
                                <x-form-group
                                    class="form-group--first"
                                    component="text-area"
                                    inputName="comment"
                                    inputPlaceholder="Publique o comentário editado."
                                    height="200"
                                    maxlength="1000"
                                    inputValue="{{ $comment->content }}"
                                ></x-form-group>

                                <x-button
                                    class="button--full-width"
                                    text="Editar comentário"
                                    :svg="file_get_contents(public_path('img/icons/edit-project-icon.svg'))"
                                ></x-button>
                            </x-form>
                        </div>
                    </x-modal>
                </div>

                <div
                    x-cloak
                    x-show="showDeleteModal"
                >
                    <x-modal onButtonCloseClick="showDeleteModal = false">
                        <p class="project-comment-list__modal-text project-comment-list__delete-comment-message">Deseja mesmo excluir seu comentário?</p>

                        <x-form
                            class="form--no-style"
                            action="{{ route('project-comment.destroy', ['project' => $project->id, 'projectComment' => $comment->id]) }}"
                            method="DELETE"
                        >
                            <x-button
                                class="button--red button--full-width"
                                text="Excluir comentário"
                                :svg="file_get_contents(public_path('img/icons/trash-icon.svg'))"
                            ></x-button>
                        </x-form>
                    </x-modal>
                </div>
            </div>
        </article>
    @endforeach

    <x-pagination :paginator="$comments"></x-pagination>
</div>
