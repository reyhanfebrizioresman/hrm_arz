<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Arenzha</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #111827;
                color: white;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            @media (prefers-color-scheme: dark) {
                :root {
                    --text: #f2f2f2;
                    --bg: #00001a;
                }
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 4em;
            }

            .title small {
                font-size: .8em;
            }

            .links > a {
                color: white;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/dashboard') }}">Menu Utama</a>
                    @else
                        <a href="{{ url('/login') }}">Masuk</a>
                        <a href="{{ url('/register') }}">Daftar</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    HRM<br /><small>Arenzha</small>
                </div>

                <div class="links">
                    <a href="https://arenzha.com/#client">Klien</a>
                    <a href="https://arenzha.com/#portfolio">Portofolio</a>
                    <a href="https://arenzha.com/#contact">Kontak</a>
                </div>
            </div>
        </div>
    </body>
</html>