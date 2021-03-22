<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @stack('prepend-style')
    @include('components.style')
    @stack('addon-style')
    <liverwire:styles></liverwire:styles>
</head>
<body class="@yield('page-class')">
    <div id="app">
        @yield('content')
    </div>

    @stack('prepend-script')
    @include('components.script')
    @stack('addon-script')
    <livewire:scripts></livewire:scripts>
</body>
</html>
