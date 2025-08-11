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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
        /* Simple fixed-ratio image box for product cards */
        .ratio-box {
            position: relative;
            width: 100%;
            padding-top: 133%;
            background: #f2f2f2;
        }

        .ratio-box>img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-title {
            min-height: 3rem;
            max-height: 3rem;
            overflow: hidden;
        }

        .topbar {
            background-color: #f8f9fa;
            border-bottom: 1px solid #eaeaea;
        }
    </style>
</head>

<body>
    <div id="app">
        @include('partials.header')

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    @include('components.cart-modal')

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('js/cart-modal.js') }}"></script>
</body>

</html>
