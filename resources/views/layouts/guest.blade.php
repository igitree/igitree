<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
         <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.1.0/themes/algolia.css" />
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
         <style type="text/css">
            .btn-google{ 
                color: #ffffff; 
                padding: 10px;
                 width: 100%; 
                 text-align: center;
                  display: block; 
                  border-radius:3px;
                    background-color: #dd4b39;
  
                }
            .btn-google:hover{
               background-color: #dd4b39;
               color: #fff;

            }
            .btn-facebook{  
              background: #3B5499;
               color: #ffffff;
                padding: 10px;
                 width: 100%;
                  text-align: center;
                   display: block;
                    border-radius:3px;

            }
            .btn-facebook:hover {
              background-color: #3B5998; 
              color: #fff;
            }

            em {
              background: cyan;
              font-style: normal;
            }

            h1 {
              margin-bottom: 1rem;
            }

            .container {
              max-width: 1200px;
              margin: 0 auto;
              padding: 1rem;
            }

            .search-panel {
              display: flex;
            }

            .search-panel__results {
              flex: 1;
            }

            #maps {
              margin-top: 1rem;
              height: 500px;
            }

         </style>
        @stack('style')
        @livewireStyles
        @stack('style')
    </head>
    <body class="bg-gray-100">
        <div class="font-sans text-gray-900 antialiased">
            @include('includes.app')            
            {{ $slot }}
        </div>
        <script src="https://cdn.jsdelivr.net/npm/scriptjs@2.5.9/dist/script.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/algoliasearch@4/dist/algoliasearch-lite.umd.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/places.js@^1.17.0"></script>
        <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4"></script>
         
        <script type="text/javascript">
                  /* global instantsearch algoliasearch $script */

            $script(
              'https://maps.googleapis.com/maps/api/js?v=weekly&key=AIzaSyBrkw8A7DCIWXlC7mKhIkjML4qJXNVmSjQ',
              () => {
                const searchClient = algoliasearch(
                  'latency',
                  '6be0576ff61c053d5f9a3225e2a90f76'
                );

                const search = instantsearch({
                  indexName: 'airports',
                  searchClient,
                });

                search.addWidgets([
                  instantsearch.widgets.places({
                    container: '#searchbox',
                    placesReference: window.places,
                  }),
                  instantsearch.widgets.geoSearch({
                    container: '#maps',
                    googleReference: window.google,
                  }),
                ]);

                search.start();
              }
            );
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        @stack('js')

    @livewireScripts 
    </body>
</html>
