<div class="container-fluid  min-h-screen  sm:justify-center items-center  sm:pt-0 bg-gray-100">
    <div class="row p-5 justify-content-center">
        <div class="col-lg-4">
            <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        <div class="col-lg-8 p-5 " style="
        position: relative;">
            <div class="message rounded-lg shadow-sm bg-white p-3" style="position: absolute;
    left: -30px;z-index: 1;">
                The if an email has already been taken.<br/>
                Try <a href="{{ route('search')}}" class="text-decoration-underline">Search</a> to see if you have been added to a family
            </div>
            <div class="row" >
                <div class="col-lg-12 pt-5  familycontainer"style="position:relative">
                    <div class="row  pb-5 rounded">
                        <div class="col-lg-12 mt-5 pt-3 ">
                            <h2 class="text-default uppercase">{{config('app.name')}} PLATFORM
                            

                            </h2>
                            <h5 class="mt-4">
                               CONNECT THE PAST WITH THE PRESENT.
                            </h5>
                            <h6 class="mt-3 text-muted">
                                Search for a specific ancestor in FamilySearch.<br> Even your best guess will do.
                            </h6> 
                        </div>
                        <div class="col-lg-12 mt-3">
                             <a href="{{route('search')}}" class="btn btn-sm btn-default">Start Searching</a>
                        </div>
                    </div> 
                </div>
            </div> 
        </div>
    </div> 
</div>
@push('style')
    <style type="text/css">
        .familycontainer{
            background-image:url({{ asset('assets/img/igitreeLogo.png') }});
            height:79vh;
            background-repeat: no-repeat; 
            background-position: right;
            background-repeat: no-repeat; 
            position: relative;


        }
        .Discover{ 
            background-image: linear-gradient(to left, rgba(243, 244, 246,0.3), rgba(243, 244, 246,1));}
    </style>
@endpush
