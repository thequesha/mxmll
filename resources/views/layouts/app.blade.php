<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', config('app.name', 'Shop'))</title>
    <meta name="description" content="@yield('meta_description', '')">
    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')">
    @endif
    @hasSection('og:title')
        <meta property="og:title" content="@yield('og:title')">
    @endif
    @hasSection('og:description')
        <meta property="og:description" content="@yield('og:description')">
    @endif
    @hasSection('og:image')
        <meta property="og:image" content="@yield('og:image')">
    @endif

    <!-- Bootstrap 4 CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-MECn2vCk1lZb2rQp0nV1YxDCEV4VpWwfvX2GpYdExlkt1/3uzMdGII4XESyqCCX5" crossorigin="anonymous">

    <style>
        /* Simple fixed-ratio image box for product cards */
        .ratio-box { position: relative; width: 100%; padding-top: 133%; background: #f2f2f2; }
        .ratio-box > img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
        .product-title { min-height: 3rem; max-height: 3rem; overflow: hidden; }
        .topbar { background-color: #f8f9fa; border-bottom: 1px solid #eaeaea; }
    </style>
</head>
<body>
    <div id="app">
        @include('partials.header')

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdDd/8N3x1Zl5kSbyw5sZ5/C/PObbIVdQydb9h9NP7VDaRao7IhiHBpjz2uVHm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B0UglyR+LyA6YI2+2nUjQmW8n26vEoYj1ZrZ6jIW3R8lBMK5n0L6J7eWc13Y9GJQ" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dropdown-hover.js') }}"></script>
</body>
</html>
