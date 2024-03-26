<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="{{asset('assets/app.css')}}">
        <title>@yield('title')</title>

    </head>
    <body>
        @include('nav.navbar')
        @yield('content')
        @include('nav.footer')
    </body>

    @include('script')
</html>
