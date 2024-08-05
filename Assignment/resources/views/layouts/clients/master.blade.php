<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shoppers &mdash; Colorlib e-Commerce Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('layouts.clients.partials.css')
</head>
<body>
    <div class="site-wrap">
        <header class="site-navbar" role="banner">
            @include('layouts.clients.partials.header-top')
            @include('layouts.clients.partials.header-nav')
        </header>

        @yield('content')

        <footer class="site-footer border-top">
            @include('layouts.clients.partials.footer')
        </footer>
    </div>

    @include('layouts.clients.partials.js')
    @yield('scripts')
</body>
</html>
