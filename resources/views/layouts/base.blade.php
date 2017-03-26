<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SiWeCos CMS-Garden - @yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="css/app.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="full-height">
            <div class="container content">
				 @yield('content')
            </div>
        </div>
    </body>
</html>
