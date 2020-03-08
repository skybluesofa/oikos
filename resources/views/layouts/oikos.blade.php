<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Oikos') }}</title>

    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .round {
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div id="oikos" class="w-screen h-screen">

        <div class="w-full h-full flex flex-row bg-red-500 sm:bg-orange-500 md:bg-yellow-500 lg:bg-green-500 xl:bg-blue-500">
            <div class="bg-white shadow-lg border-t-4 border-indigo-500 absolute bottom-0 w-full md:w-0 md:hidden flex flex-row flex-wrap">
                <div class="w-full text-right"><button class="p-2 fa fa-bars text-4xl text-gray-600"></button></div>
            </div>
            <div class="w-0 md:w-2/12 lg:w-1/12 h-0 md:h-full overflow-y-hidden bg-gray-900 shadow-lg">
                @include('components.navigation.content')
            </div>
            <div class="w-full md:w-10/12 lg:w-11/12 p-5 h-full overflow-x-scroll antialiased">
                @include('components.stream.content')
            </div>
        </div>

    </div>
</body>