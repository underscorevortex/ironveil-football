```blade
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('irongate-icon.png?v=2') }}">
    <title>{{ config('app.name', 'IronGate Football Academy') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="ig-body">

    <div class="ig-auth-page">

        <div class="ig-auth-card">

            {{-- Brand --}}
            <a href="{{ url('/') }}" class="ig-auth-brand">
                <div class="ig-brand-mark">
                    IG
                </div>

                <div class="ig-brand-text">
                    <span>IRON<span>GATE</span></span>
                    <small>FOOTBALL ACADEMY</small>
                </div>
            </a>

            {{-- Authentication Content --}}
            <div class="ig-auth-content">
                {{ $slot }}
            </div>

        </div>

        <div class="ig-auth-footer">
            IronGate Football Academy
        </div>

    </div>

</body>

</html>
```
