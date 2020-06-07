<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="vertical-layout vertical-menu-modern 1-column bg-dark blank-page pace-done">
<header>
    @include('partials.header')
</header>

<div class="app-content content">
    @yield('content')
</div>

<footer>
    @include('partials.footer')
</footer>
@include('partials.scripts')
</body>
</html>
