<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'ResuMatik') }}</title>

        <meta name="description" content="Build a professional resume online for free with ResuMatik. No sign-up required — fill in your details, preview instantly, choose from 80 designer templates, and download a polished, ATS-friendly PDF." />
        <meta name="keywords" content="free resume maker, resume builder online, cv maker, no login resume builder, resume templates, ATS resume builder, resume pdf download, ResuMatik" />
        <meta name="robots" content="index, follow" />
        <link rel="canonical" href="{{ url()->current() }}" />

        <!-- Open Graph -->
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="{{ config('app.name', 'ResuMatik') }}" />
        <meta property="og:title" content="ResuMatik — Free Resume Maker Online, No Sign-Up Required" />
        <meta property="og:description" content="Build a professional resume online for free. No account needed — live preview, 80 designer templates, download your PDF the moment you're ready." />
        <meta property="og:url" content="{{ url('/') }}" />
        <meta property="og:image" content="{{ asset('og-image.png') }}" />

        <!-- Twitter -->
        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="ResuMatik — Free Resume Maker Online, No Sign-Up Required" />
        <meta name="twitter:description" content="Build a professional resume online for free. No account needed — live preview, 80 designer templates, download your PDF the moment you're ready." />
        <meta name="twitter:image" content="{{ asset('og-image.png') }}" />

        <meta name="theme-color" content="#4f46e5" />

        <!-- Favicon -->
        <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml" />
        <link rel="icon" href="{{ asset('favicon-32x32.png') }}" type="image/png" sizes="32x32" />
        <link rel="icon" href="{{ asset('favicon-16x16.png') }}" type="image/png" sizes="16x16" />
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}" />

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
