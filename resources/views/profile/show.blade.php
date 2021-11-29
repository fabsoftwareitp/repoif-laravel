@php
    $pageOgImageUrl = $user->photo_path
        ? asset('storage/' . $user->photo_path)
        : asset('img/thumbnails/profile-without-photo-thumbnail.png');
@endphp

<x-layout
    pageTitle="Perfil de {{ $user->name }} - RepoIF"
    pageDescription="Página do perfil de {{ $user->name }} no RepoIF, onde constam seus dados e projetos publicados"
    pageOgTitle="Perfil de {{ $user->name }} - RepoIF"
    pageOgDescription="Página do perfil de {{ $user->name }} no RepoIF, onde constam seus dados e projetos publicados"
    :pageOgImageUrl="$pageOgImageUrl"
>
    <main class="container profile-show">
        <x-profile-card :user="$user"></x-profile-card>
    </main>
</x-layout>
