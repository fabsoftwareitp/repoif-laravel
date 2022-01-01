<x-layout
    pageTitle="RepoIF: repositório para projetos de alunos do IFSP"
    pageDescription="No repositório se encontram projetos (documentos, imagens, vídeos e projetos web) desenvolvidos por alunos do IFSP"
    pageOgTitle="RepoIF: repositório para projetos de alunos do IFSP"
    pageOgDescription="No repositório se encontram projetos (documentos, imagens, vídeos e projetos web) desenvolvidos por alunos do IFSP"
    :pageOgImageUrl="asset('img/logos/logo-repoif-og.png')"
>
    <main class="container project-index">
        <x-project-view :projects="$projects"></x-project-view>
    </main>
</x-layout>
