<!DOCTYPE html>

<html lang="pt-BR">

    <head>
        <meta charset="UTF-8">

        <title>{{ $pageTitle }}</title>
        <meta name="description" content="{{ $pageDescription }}">

        <meta property="og:locale" content="pt_BR">
        <meta property="og:site_name" content="RepoIF">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $pageOgTitle }}">
        <meta property="og:description" content="{{ $pageOgDescription }}">
        <meta property="og:image" content="{{ $pageOgImageUrl }}">
        <meta name="twitter:card" content="summary_large_image">

        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset("img/favicons/apple-touch-icon.png") }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset("img/favicons/favicon-32x32.png") }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("img/favicons/favicon-16x16.png") }}">
        <link rel="manifest" href="{{ asset("img/favicons/site.webmanifest") }}">
        <link rel="mask-icon" href="{{ asset("img/favicons/safari-pinned-tab.svg") }}" color="#00ec7e">
        <link rel="shortcut icon" href="{{ asset("img/favicons/favicon.ico") }}">
        <meta name="msapplication-TileColor" content="#00ec7e">
        <meta name="msapplication-config" content="{{ asset("img/favicons/browserconfig.xml") }}">
        <meta name="theme-color" content="#00ec7e">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="{{ asset(mix("css/app.css")) }}">
    </head>

    <body>
        <div class="app">
            <div class="header"></div>
            <div class="body">
                {{ $slot }}
            </div>
            <x-footer></x-footer>
        </div>
    </body>

</html>
