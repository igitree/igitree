<section> 
<div class="container"> 
    <div class="row"> 
      <div class="col-lg-12 ">  
            <div class="row mt-3 justify-content-center"> 
              <div class="col-lg-12 mt-2">
                  <div class="row"> 
                    <div class="d-flex flex-row ">
                      <div class="flex-grow-1">
                        <h3 class="text-muted">Create your family Album</h3> 
                      </div>
                      <div class="ml-5"> 
                      <button type="button" class="btn btn-sm btn-default "data-toggle="modal"
                          data-target="#image-gallery"><i class="fa fa-plus"></i> Add New</button>
                    </div>
                    </div>   
                      </div>
                  </div>
              </div> 
          </div> 
        </div>  
         <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="image-gallery-title text-default">New Album</h4>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                        </button>
                    </div> 
                      <div class="card-body col-lg-12">
                          <form wire:submit.prevent="save" class="row"> 
                               <div class="col-lg-12 mb-2">
                                   @csrf
                                    <!-- title input -->
                                    <div class="form-outline mb-4">
                                      <label class="form-label"  for="form4Example1">Album Title</label>
                                      <input type="text" id="" wire:model.defer="state.title" class="form-control"  required/>
                                      
                                    </div> 
                                    <!-- description input -->
                                    <div class="form-outline mb-4">
                                      <label class="form-label" for="form4Example3">Album description</label>
                                      <textarea class="form-control" data-note="@this"  wire:model.defer="state.description" id="note" rows="5" ></textarea>
                                      
                                    </div>  
                              </div>
                               <div class="col-lg-12 mb-2">
                                  <!-- Submit button -->
                                    <button type="submit" class="submit btn btn-default btn-block mb-4">Save</button>
                              </div> 
                          </form>
                      </div> 
                </div>
            </div>
        </div> 
</section>

<div class="container-fluid">
  <div class="row justify-content-center">
    <div class=" col-lg-2 col-md-2 col-xs-12 shadow-sm rounded-lg bg-white listAlbum mt-4 mb-2">
        <div class="row text-truncate">
           @forelse($Albums as $Album)
            <a href="{{ route('albums.show',$Album->id) }}" class="col-lg-12 border-bottom p-2 text-truncate"> 
              <div class="d-flex flex-row text-truncate">
                <div class="flex-grow-1 text-truncate">
                    {{ $Album->title }}
                    @php
                      $created_at = \Carbon\Carbon::parse($Album->created_at);
                    @endphp
                     
                </div>
                <div class="text-truncate"> 
                  <small>{{ $created_at->diffForHumans() }}</small>
                </div>
              </div>
             
            </a> 
           @empty
              <span class="text-muted"> No Album Added</span>
            @endforelse 
        </div>
    </div>
    <div class=" col-lg-8  col-md-8 col-xs-12">
       <div class="card rounded-0" style="position:relative;"> 
      @if(!empty($Albums))
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators"> 
                @for ($i = 1; $i <= count($Albums); $i++)
                 <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                @endfor
            </ol>
            <div class="carousel-inner" style="width:100%;">
              <div class="bgTitle"></div>
                @forelse($Albums as $Album)
                    @php  
                        // $familyUsers=\App\Models\Family::where('f_indentity',$Album->f_indentity)->get()->first();
                    @endphp
                <div class="carousel-item   {{ $loop->first? 'active':'' }}">
                    <div class="row h-100 align-items-center">
                        <div class="col-lg-7 d-flex justify-content-center align-items-center title"> 
                          <div class="col-lg-12  mt-3">
                            <div class="card-cover">
                              <div class="card-top-left"></div> 
                              <div class="card-bottom-right"></div>
                                <a href="{{ route('albums.show',$Album->id) }}">
                                   {{-- @if($Album->photos->count() !=0) --}}
                                      {{-- <img src="{{ asset('storage/photos/'.$Album->photos[0]->i_image)}}" style="height: 200px; width: 100%; display: block;">
                                    @else --}}

                                      <img class="card-img-top" style="height: 225px; width: 100%; display: block;" src="{{asset('assets/img/gcc49c4df57f096dbc5fc4d59c9d9e8a62cddbcb14adaac85608e418c6fd6579e5526e396fd5a2bb1669fb38d790e2406_640.jpg')}}">
                                   {{--  @endif --}} 
                                </a> 
                                <div class="card-body"> 
                                  <small class="text-white">Created {{ $Album->created_at }}   by {{$Album->u_fullname}}</small>
                                  <p class="text-white text-default text-right"><small> {{-- {{ $Album->photos->count() }} --}} Photos Added</small></p> 
                                  <div class="d-flex justify-content-between align-items-center">
                                {{--     <div class="viewmore">  
                                      <form action="#" method="POST">
                                      @csrf  
                                      <button class="btn btn-sm btn-danger">
                                        <svg class="svg-icon danger" viewBox="0 0 20 20">
                                          <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                        </svg>
                                      </button>
                                    </form>
                                    </div> --}}
                                  </div>
                                </div>
                            </div> 
                            </div>
                        </div>
                        <div class="col-lg-4 content">
                          <h3 class="text-default">{{ $Album->title }}</h3>
                            {!! $Album->description !!}
                           {{--  @if($Album->photos->count() != 0) --}}
                               <span class="text-muted"> </span> 
                                <a href="{{ route('albums.show',$Album->id) }}" class="text-decoration-underline">View image collection</a>
                                <a href="{{ route('albums.settings',$Album->id) }}" title="Add new images" class="d-flex flex-row btn btn-sm border addmore mt-2"> <span class="m-1">Add more memories</span>
                                </a>
                              {{-- @else --}}
                              <br>  
                              <a href="{{ route('albums.settings',$Album->id) }}"><i class="fa fa-plus"></i> Add images to this album </a><br>
                              <a href="{{ route('singleprofile',$Album->user_id) }}" class="text-muted"> Owned by {{$Album->u_fullname}}</a>
                              
                            {{-- @endif --}} 
                        </div>
                    </div>
                </div> 
                  @php
                  $no=true
                @endphp
                @empty
                @php
                  $no=false
                @endphp
                  <div class="justify-content-center mt-5">
                    <svg class="svg-icon" viewBox="0 0 20 20">
                        <path fill="none" d="M19.521,7.267c-0.144-0.204-0.38-0.328-0.631-0.328h-3.582l-0.272-1.826c-0.055-0.379-0.379-0.656-0.76-0.656
                        H9.802l-0.39-0.891c-0.123-0.279-0.399-0.46-0.704-0.46H1.11c-0.222,0-0.434,0.096-0.58,0.264C0.385,3.537,0.319,3.76,0.349,3.981
                        l1.673,12.243c0,0,0,0,0,0.002v0.004c0.015,0.113,0.06,0.213,0.119,0.303c0.006,0.009,0.006,0.023,0.012,0.033
                        c0.012,0.016,0.033,0.024,0.046,0.04c0.054,0.065,0.114,0.118,0.185,0.161c0.027,0.018,0.051,0.035,0.078,0.048
                        c0.099,0.045,0.206,0.078,0.32,0.078h0.002l0,0h13.03c0.323,0,0.611-0.201,0.722-0.505l3.076-8.416
                        C19.698,7.735,19.663,7.474,19.521,7.267z M8.203,4.644l0.391,0.889c0.123,0.279,0.399,0.461,0.704,0.461h4.315l0.141,0.944H5.859
                        c-0.323,0-0.611,0.201-0.723,0.505l-2.011,5.505L1.992,4.644H8.203z M15.276,15.356H3.882l2.515-6.879H17.79L15.276,15.356z"></path>
                      </svg><span class="text-muted"> No Album Added</span>

                  </div> 
                @endforelse 
            </div>
        </div>
        @if($no)
        <button class="btn btn-next btn-default">Next</button>
        @endif
        @else
        <div class="row justify-content-center mt-5">
          <div class="col-lg-3">
            <x-noImages/> 
          </div>
        </div> 
        @endif
    </div>
    </div>
  </div>
   

</div>

@push('style')

<style>
  .listAlbum{
    height: 100%;
  }
  .listAlbum a{
    color: #000;
  }

  .listAlbum a:hover{
    background: #0d6efd;
    color: #fff;
  }

  .svg-icon {
  width: 4em;
  height: 4em; 
  text-align: center;
}

.svg-icon path,
.svg-icon polygon,
.svg-icon rect {
  fill: #1260CC;
}
body{ 
  font-family: 'Montserrat', sans-serif;
}
.container{
  display: flex;
  justify-content: center;
  align-items: center;
}
h1{
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  width: 100%;
  text-align: center;
  color: #fff;
}

.card{
  border-radius: 20px; 
  width: 90%;
  background: none; 
  border: none;
}

.carousel-item{
  z-index: 2;
  /*padding: 10px 25px;*/
}
.carousel-item > .row{
  margin: 0;
} 
.bgTitle{
    background-color: none;
    position: absolute;
    z-index: 1;
}
 

.btn-next{
  position: absolute;
  bottom: 15px;
  right: 15px;
  width: 100px;
  border-radius: 20px; 
  box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
  z-index: 3;
}

input{
  background-color: transparent !important;
}

/*-- vertical bootstrap slider --*/
.carousel .carousel-item-next.carousel-item-left,
.carousel .carousel-item-prev.carousel-item-right {
    -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0);
}

.carousel .carousel-item-next,
.carousel .active.carousel-item-right {
    -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100% 0);
}

.carousel .carousel-item-prev,
.carousel .active.carousel-item-left {
-webkit-transform: translate3d(0,-100%, 0);
        transform: translate3d(0,-100%, 0);
}

/*-- vertical carousel indicators --*/
.carousel-indicators{
    position: absolute;
    top: 0;
    bottom: 0;
    margin: auto;
    height: 40px;
    right: 0px;
    left: auto;
    width :auto;
    -webkit-transform: rotate(90deg);
    -moz-transform: rotate(90deg);
    -ms-transform: rotate(90deg);
    -o-transform: rotate(90deg);
    transform: rotate(90deg);
}
.carousel-indicators li{
    display: block;
    margin-bottom: 0px;
    border-radius: 50%;
    width: 10px;
    height: 10px;
    background: #1260CC;
    transition: all ease 0.6s;
}
.carousel-indicators li.active{
    background: #1260CC;
    width: 20px;
    border-radius: 25px;
}
/* Media Querys */
/* Small devices (landscape phones, 576px and up)*/ 
@media (min-width: 576px) {
  .bgTitle{
    height: 30%;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    width: 100%;
    top: 0;
  }
  .content{
    padding: 15px;
  }
}

/* Medium devices (tablets, 768px and up)*/
@media (min-width: 768px) {

}

/* Large devices (desktops, 992px and up)*/
@media (min-width: 992px) {
  .bgTitle{
    height: 100%;
    width: 50%;
    border-bottom-left-radius: 15px;
    border-top-right-radius: 0px;
  }
}

/* Extra large devices (large desktops, 1200px and up)*/
@media (min-width: 1200px) {

} 

    h3{
      font-family: "Sofia", sans-serif;
    }

    
    .text-dark{
      color: black;
      text-decoration: underline;
    }
    .card-cover{
      margin: 20px;
      border: 7px solid #FEFFFA;
      border-radius: 0px;
    background-image: linear-gradient(to bottom, rgba(18,96,204,0), rgba(18,96,204,.8));
        -webkit-box-shadow: 0px 0px 0px 5px #FEFFFA, inset 0px 10px 27px -8px #141414, inset 50px 43px 50px 45px rgba(250,250,250,0); 
      box-shadow: 0px 0px 0px 5px #FEFFFA, inset 0px 10px 27px -8px #141414, inset 50px 43px 50px 45px rgba(250,250,250,0);

    }

    .card-top-left{
            padding: 20px 0px 53px 14px;
          position: absolute;
          background-color:#DDC481;
          -ms-transform: rotate(45deg);
          -ms-transform-origin: 20% 40%;
          transform: rotate(
      45deg);
          transform-origin: 20% 40%;
          top: -7px;
          left: 37px;
    }

    .card-bottom-right{
       padding: 20px 0px 53px 14px;
      position: absolute;
      background-color:#DDC481;
      -ms-transform: rotate(45deg);
      -ms-transform-origin: 20% 40%;
      transform: rotate( 
  45deg);
      transform-origin: 20% 40%;
      bottom: -2px;
      right: 30px;
    } 


    .card-body{
      padding:10px;
    }

    .viewmore {
  height: 0;
  opacity: 0;
  visibility: hidden;
  margin: 5px;
  line-height: 1.5em;
  
}



.card-cover:hover .viewmore{
  height: 4em;
  opacity: 1;
  visibility: visible;
  transition: all .2s ease;
}
.header-section{
  margin-bottom: 10px;
}




  </style>
@endpush
@push('js')
  <script>
         ClassicEditor
        .create( document.querySelector( '#note' ) )
        .then(editor => {
        document.querySelector('.submit').addEventListener('click', () =>{ 
            let note=$('#note').data('note');
            eval(note).set('state.description',editor.getData());
          });
          
         
        })
        .catch( error => {
            console.error( error );
        } );
    </script> 

    
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.2.0/anime.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('.carousel').carousel({
  interval:0
});
$('.btn-next').click(function(){
  $('.carousel').carousel('next');
});

  </script>
@endpush