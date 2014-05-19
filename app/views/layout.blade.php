<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Wikidown</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/main.css" />

        @yield('head')
    </head>
    <body>
        <div class="container">
            @yield('body')
        </div>

        @yield('foot')
    </body>
</html>