<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Wikidown</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/assets/main.css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        @yield('head')
    </head>
    <body>
        <div class="container main-container">
            <div class="layout-outer">
                <div class="navigation">
                    {{ $menu }}
                </div>
                <div class="theContent">
                    @yield('body')
                </div>
            </div>
        </div>
        @yield('foot')
    </body>
</html>