<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Igitree') }}</title> 
        <!-- font -->
        <link href="{{ asset('dist/font/font-fileuploader.css') }}" media="all" rel="stylesheet">

        <link href="{{ asset('assets/img/igitreeLoo.png') }}" rel="icon">
        <!-- css -->
        <link href="{{ asset('dist/jquery.fileuploader.min.css')}}" media="all" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- js -->
        <script src="//code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="{{ asset('dist/jquery.fileuploader.min.js') }}" type="text/javascript"></script>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
                
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
                 
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
       
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}"> 
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/toastr.min.css')  }}">


         <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="https://d3js.org/d3.v3.min.js" type="text/javascript"></script>
          <script src="https://d3js.org/d3.v3.js" charset="utf-8"></script>
        <script src="https://cdn.jsdelivr.net/gh/deltoss/d3-mitch-tree@1.0.2/dist/js/d3-mitch-tree.min.js"></script> 
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/deltoss/d3-mitch-tree@1.0.2/dist/css/d3-mitch-tree-default.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/deltoss/d3-mitch-tree@1.0.2/dist/css/d3-mitch-tree.min.css"> 
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.1.0/themes/algolia.css" />
        <link rel="stylesheet" href="https://unpkg.com/treeflex/dist/css/treeflex.css">
        @livewireStyles
        @stack('style')

    </head>
    <body class="font-sans antialiased"  onload="myFunction()">
        
        <div id="loader"> 
            <div class="spinner-grow" role="status">
              <span class="sr-only"></span>
            </div>  
        </div>
        <x-jet-banner /> 

        <div class="min-h-screen bg-gray-100 animate-bottom" style="display:none;" id="myDiv">
            <x-navbar.app/>

            @livewire('navigation-menu')
            @include('includes.app') 
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white">
                    <div class="max-w-7xl mx-auto py-3 text-muted ">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main> 
                {{ $slot }}
            </main>
        </div>
    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
     <script src="https://cdn.ckeditor.com/ckeditor5/23.0.0/classic/ckeditor.js"></script>
 <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
     <script type="text/javascript" src="{{ asset('assets/js/toastr.min.js')  }}"></script>   
<script>
  $(document).ready(function(){
    toastr.options = {
          "closeButton": true,
          "debug": true,
          "newestOnTop": false,
          "progressBar": false, 
          'positionClass': 'toast-top-right',
          "preventDuplicates": true,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
  window.addEventListener('success',event =>{
    $("#form_pop").hide();
    toastr.success(event.detail.message, 'success !');
  });

     toastr.options = {
          "closeButton": true,
          "debug": true,
          "newestOnTop": false,
          "progressBar": false,
         'positionClass': 'toast-top-right',
          "preventDuplicates": true,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }
  window.addEventListener('error',event =>{
    $("#form_pop").hide();
    toastr.error(event.detail.message, 'Error !');
  });
  
  });
</script>

<script>
  function CopyFamilyCodes() { 
            var copyText = document.getElementById("myInputfamily");
            var button=document.getElementById("myButtin1");
           
            copyText.select();
            copyText.setSelectionRange(0, 99999);  
            navigator.clipboard.writeText(copyText.value);
            
           
           button.innerHTML = "copied";
          }
          
function CopyPersonalCodes() {
   
  var copyText = document.getElementById("myInputCode");
    var button=document.getElementById("myButtin");

  
  copyText.select();
  copyText.setSelectionRange(0, 99999);  

 
  navigator.clipboard.writeText(copyText.value);
  
 
 button.innerHTML = "copied";
}



</script>
<script>
var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 30);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>
    @stack('modals')
    @stack('js')

    @livewireScripts 

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
    </body>
</html>
