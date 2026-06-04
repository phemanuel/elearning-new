<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Management Blueprint</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
     <link rel="icon" type="image/png" href="{{asset('frontend/dist/images/favicon/favicon.png')}}" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: #fff;
            color: #000;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1; /* This pushes the footer to the bottom */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        footer {
            background: #111122;
            color: #ccc;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
    </style>
    @stack('head')
</head>
<body>
    <header class="bg-gray-900 text-white p-4 text-center font-bold">
        Social Media Management Blueprint
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} KingsDigiHub. All rights reserved.
        <br>
        This site is not affiliated with Meta Platforms, Inc., Facebook, or Instagram.
    </footer>

    @stack('scripts')
</body>
</html>