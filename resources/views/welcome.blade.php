<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
            integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <style>
            /* .router-link-active {
                font-weight: bold;
            } */
            .active-menu{
                font-weight: bold;
            }
        </style>
        <title>Laravel</title>
    </head>
    <body>
        @if (Auth::check())
            @php
            $user_auth_data = [
                'isLoggedin' => true,
                'user' =>  Auth::user()
            ];
            @endphp
        @else
            @php
            $user_auth_data = [
                'isLoggedin' => false
            ];
            @endphp
        @endif
        <script>
            window.Laravel = JSON.parse(atob('{{ base64_encode(json_encode($user_auth_data)) }}'));
        </script>

        <div id="app">
            <app></app>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
