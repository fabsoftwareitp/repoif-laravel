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
    <div style="color: #fff; font-size: 20px;">
        <h1>Título: {{ $project->title }}</h1>
        <p>Visualizações: {{ $project->views }}</p>
    </div>
</x-layout>
