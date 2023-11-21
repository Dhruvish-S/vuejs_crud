<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" value="{{ csrf_token() }}"/>
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <title>CRUD</title>
        {{-- <link href="{{ @vite('css/app.css') }}" ref="stylesheet"> --}}

        @vite('resources/css/app.css')

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    </head>
    <body>
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>

</html>
