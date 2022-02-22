 
<nav class="navbar navbar-icon-top navbar-expand-lg text-muted navbar-white bg-white shadow-sm sticky-top" style="position: relative;">
  <a href="{{ route('dashboard') }}">
      <x-jet-application-mark class="block h-9 w-auto">
          </x-jet-application-mark>
    </a>
  <button class="navbar-toggler text-default "  type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> 
    <i class="fa fa-bars" aria-hidden="true"></i>
  </button>

  <div class="collapse navbar-collapse ml-3" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item  {{request()->routeIs('dashboard')?'activeLink':''}}">
        <a class="nav-link text-muted"  href="{{ route('dashboard') }}"> 
          Home 
          </a>
      </li> 
      <li class="nav-item  {{request()->routeIs('tree')?'activeLink':''}}">
        <a class="nav-link text-muted" href="{{ route('tree') }}"> 
         Tree
          </a>
      </li>
      <li class="nav-item  {{request()->routeIs('dna')?'activeLink':''}}">
        <a class="nav-link text-muted" href="{{ route('dna') }}"> 
          DNA
          </a>
      </li>

      <li class="nav-item    {{request()->routeIs('chat')?'activeLink':''}}" >
        <a class="nav-link text-muted" href="{{ route('chat') }}"> 
         Chat
          </a>
      </li> 

      <li class="nav-item  {{request()->routeIs('album')?'activeLink':''}} {{  request()->routeIs('albums.settings')?'activeLink':'' }}{{ request()->routeIs('albums.show')?'activeLink':''}}">
        <a class="nav-link text-muted" href="{{ route('album') }}"> 
         Album
          </a>
      </li> 

        <li class="nav-item  {{request()->routeIs('status')?'activeLink':''}}"> 
        <a class="nav-link text-muted" href="{{ route('status') }}"> 
          Stories 
          </a>
      </li>
    
      <li class="nav-item  {{request()->routeIs('pricing')?'activeLink':''}}">
        <a class="nav-link text-muted" href="{{ route('pricing') }}"> 
          Pricing
          </a>
      </li>
      <li class="nav-item  {{request()->routeIs('contact')?'activeLink':''}}">
        <a class="nav-link text-muted" href="{{ route('contact') }}"> 
          Contact us
          </a>
      </li> 
    </ul>
    <ul class="navbar-nav ">
      <li class="nav-item  {{request()->routeIs('search')?'activeLink':''}}" title="Search">
        <a class="nav-link text-muted" href="{{ route('search') }}"> 
            <i class="fa fa-search">
            </i> 
          </a>
      </li>
       @if(Auth::check())
      <li class="nav-item  {{request()->routeIs('updates')?'activeLink':''}}" title="Notifications">  
        <x-jet-dropdown align="right" width="48">
              <x-slot name="trigger"> 
                  <a class="nav-link text-muted" style="position:relative;" href="#" >
                    <i class="fa fa-bell">
                    </i>

                     @if (auth()->user()->unreadNotifications->count())
                          <span class="badge rounded-pill badge-notification bg-danger " id="notify" style="position: absolute;top: 6px;left: 4px;display:block;width: 10px;height:10px"> 
                          </span>
                      @endif 
                  </a> 
              </x-slot>
              <x-slot name="content">
                  <!-- Notification Management -->
                  <div class="block px-4 py-2 text-xs text-gray-400">
                      {{ __('Notifications') }}
                  </div>
                  <div class="text-xs text-gray-400">  
                      <x-jet-dropdown-link href="{{route('updates')}}" class="text-decoration-underline">
                            {{ __('Load more notifications') }}
                        </x-jet-dropdown-link> 
                  </div> 
              </x-slot> 
          </x-jet-dropdown> 
      </li>  
      @endif 
      <li class="nav-item"> 
        <div class="ml-3 relative">
          @if(Auth::check())
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                              @if(!empty(auth()->user()->profile_photo_path)) 
                                <img alt="{{ Auth::user()->u_fullname }}" class="h-8 w-8 rounded-full object-cover" src=" {{asset('storage/'.auth()->user()->profile_photo_path)}}"/>
                                @else
                                  <img alt=""  class="h-8 w-8 rounded-full object-cover" src="{{asset('/assets/img/account.jpg')}}">
                              @endif
                            </button>
                            @else
                            <span class="inline-flex rounded-md">
                                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition" type="button">
                                    {{ Auth::user()->u_fullname }}
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" fill-rule="evenodd">
                                        </path>
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>
                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>
                            <x-jet-dropdown-link href="{{ route('singleprofile',auth()->user()->u_id) }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>
                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Edit Profile') }}
                            </x-jet-dropdown-link>
                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                            @endif
                            <div class="border-t border-gray-100">
                            </div>
                            <!-- Authentication -->
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown> 
                    @else 
                        <a class="btn btn-sm btn-default nav-link text-white " href="{{ route('login') }}"> 
                         Login
                        </a> 
                  @endif
                </div> 
      </li>
    </ul>
 {{--    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> --}}
  </div>
</nav> 


@push('style')
  <style type="text/css">
    i{
      font-size:20px;
      color: #f1f1f1;
    }
    #notify{
        position: absolute;
        top: 0px;
        left: 0px;
    }
  </style>
@endpush