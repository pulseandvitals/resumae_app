<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'ResumAE') }}</title>

        <meta name="description" content="Build a professional resume online for free with ResumAE. No sign-up required — fill in your details, preview instantly, choose from 10 designer templates, and download a polished PDF." />
        <meta name="keywords" content="free resume maker, resume builder online, cv maker, no login resume builder, resume templates, resume pdf download" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="{{ url()->current() }}" />

        <!-- Open Graph -->
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="{{ config('app.name', 'ResumAE') }}" />
        <meta property="og:title" content="ResumAE — Free Resume Maker Online, No Sign-Up Required" />
        <meta property="og:description" content="Build a professional resume online for free. No account needed — live preview, 10 designer templates, download your PDF the moment you're ready." />
        <meta property="og:url" content="{{ url('/') }}" />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:title" content="ResumAE — Free Resume Maker Online, No Sign-Up Required" />
        <meta name="twitter:description" content="Build a professional resume online for free. No account needed — live preview, 10 designer templates, download your PDF the moment you're ready." />

        <meta name="theme-color" content="#4f46e5" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
