<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

      <style type="text/css">
          body { }
                .error-template {padding: 40px 15px;text-align: center;margin-top:90px;}
                .error-actions {margin-top:15px;margin-bottom:15px;}
                .error-actions .btn { margin-right:10px; }
      </style>
    </head>
    <body class="antialiased"> 
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template">
                        <h1>
                            Oops!</h1>
                        <h2>
                             @yield('code') @yield('message')</h2>
                        <div class="error-details">
                            Sorry, an error has occured, @yield('message')!
                        </div>
                        <div class="error-actions">
                            <a href="{{route('dashboard')}}" class="btn btn-default"></span>
                                Take Me Home </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
