<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('irongate-icon.png?v=2') }}">

    <title>{{ config('app.name', 'IronGate Football Academy') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="ig-body">

    <div class="ig-app">

        @include('layouts.navigation')

        <main class="ig-main">

            @isset($header)
                <div class="ig-page-header">
                    <div class="ig-container">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <div class="ig-container ig-content">
                {{ $slot }}
            </div>

        </main>

    </div>

</body>
</html>