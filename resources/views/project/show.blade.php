@php
    $pageOgImageUrl = match ($project->type) {
        1 => asset("img/thumbnails/document-project-thumbnail.png"),
        2 => asset("storage/" . $project->path),
        3 => ProjectHelper::getVideoProjectThumbnailUrl($project->url),
        4 => asset("img/thumbnails/web-project-thumbnail.png"),
    };
@endphp

<x-layout
    pageTitle="{{ $project->title }} - RepoIF"
    pageDescription="{{ $project->description ?: 'Projeto publicado por ' . $project->user->name . ' no RepoIF.' }}"
    pageOgTitle="{{ $project->title }} - RepoIF"
    pageOgDescription="{{ $project->description ?: 'Projeto publicado por ' . $project->user->name . ' no RepoIF.' }}"
    :pageOgImageUrl="$pageOgImageUrl"
>
    <main class="container project-show">
        <x-project-view
            :project="$project"
            :userLikedProject="$userLikedProject"
        ></x-project-view>
    </main>

    @once
        @push("additional")
            <script>
                window.addEventListener("load", () => {
                    const readButtons = document.querySelectorAll(".read-button");

                    readButtons.forEach(readButton => {
                        const { readElement, showText } = readButton.dataset;

                        readButton.readElement = document.getElementById(readElement);
                        readButton.textContent = showText;
                    });

                    function toggleReadElementAndReadButton(event) {
                        const readButton = event.target;
                        const { readElement } = readButton;
                        const { showText, hideText } = readButton.dataset;

                        readElement.classList.toggle("read-limited");
                        readButton.textContent =
                            readButton.textContent === showText
                            ? hideText
                            : showText;
                    }

                    function adjustReadElementsAndReadButtons() {
                        readButtons.forEach(readButton => {
                            const { readElement } = readButton;
                            const { showText } = readButton.dataset;
                            const readElementMaxHeight = 66;

                            if (
                                readElement.scrollHeight > readElementMaxHeight &&
                                readButton.textContent === showText
                            ) {
                                readElement.classList.add("read-limited");
                                readButton.classList.add("read-button--show");
                                readButton.addEventListener("click", toggleReadElementAndReadButton);
                            } else if (readElement.scrollHeight <= readElementMaxHeight) {
                                readElement.classList.remove("read-limited");
                                readButton.classList.remove("read-button--show");
                                readButton.removeEventListener("click", toggleReadElementAndReadButton);
                                readButton.textContent = showText;
                            }
                        });
                    }

                    adjustReadElementsAndReadButtons();
                    window.addEventListener("resize", adjustReadElementsAndReadButtons);
                });
            </script>
        @endpush
    @endonce

</x-layout>
