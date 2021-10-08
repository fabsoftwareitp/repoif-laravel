<x-layout
    pageTitle="Perfil de {{ $user->name }} - RepoIF"
    pageDescription="Página do perfil de {{ $user->name }} no RepoIF, onde constam seus dados e projetos publicados"
    pageOgTitle="Perfil de {{ $user->name }} - RepoIF"
    pageOgDescription="Página do perfil de {{ $user->name }} no RepoIF, onde constam seus dados e projetos publicados"
    :pageOgImageUrl="asset('storage/' . $user->photo_path)"
>
    <main class="container profile-show">
        <x-profile-card :user="$user"></x-profile-card>
    </main>
</x-layout>
