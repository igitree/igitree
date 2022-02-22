<section> 
<div class="container" wire:poll> 
    <div class="row justify-content-center"> 
      <div class="col-lg-12 ">  
            <div class="row mt-3 justify-content-center"> 
              <div class="col-lg-12 mt-2">
                  <div class="row"> 
                    <div class="d-flex flex-row ">
                      <div class="flex-grow-1"> 
                          <h3 class="text-muted">Family Archives from {{ $Album->title }}</h3> 
                      </div>
                      <div class="ml-5"> 
                      <a href="{{ route('albums.settings',$Album) }}" title="Add new images"><svg class="svg-icon" viewBox="0 0 20 20">
                        <path fill="none" d="M13.68,9.448h-3.128V6.319c0-0.304-0.248-0.551-0.552-0.551S9.448,6.015,9.448,6.319v3.129H6.319
                          c-0.304,0-0.551,0.247-0.551,0.551s0.247,0.551,0.551,0.551h3.129v3.129c0,0.305,0.248,0.551,0.552,0.551s0.552-0.246,0.552-0.551
                          v-3.129h3.128c0.305,0,0.552-0.247,0.552-0.551S13.984,9.448,13.68,9.448z M10,0.968c-4.987,0-9.031,4.043-9.031,9.031
                          c0,4.989,4.044,9.032,9.031,9.032c4.988,0,9.031-4.043,9.031-9.032C19.031,5.012,14.988,0.968,10,0.968z M10,17.902
                          c-4.364,0-7.902-3.539-7.902-7.903c0-4.365,3.538-7.902,7.902-7.902S17.902,5.635,17.902,10C17.902,14.363,14.364,17.902,10,17.902
                          z"></path>
                      </svg></a>
                    </div>
                    </div>   
                      </div>
                  </div>
              </div> 
          </div> 
        </div>
        <div class="row justify-content-center">
          @if($Album->photos)  
         <div class="demo-gallery mt-3">
            <ul id="lightgallery" class="list-unstyled row">
               @forelse($Album->photos as $photos) 
                <li class="col-lg-3" data-responsive="{{ asset('storage/photos/'.$photos->i_image)}}" data-src="{{ asset('storage/photos/'.$photos->i_image)}}" data-sub-html="<h4>{{ 'igitree image' }}</h4><p>{{ $photos->caption}}</p>">
                    <a href="">
                        <img class="img-thumbnail border-0 rounded-0" src="{{ asset('storage/photos/'.$photos->i_image)}}" style="width:340px;height:200px">
                    </a>
                </li>
                    @empty
                    <div class="p-5"> No Photos found</div>
                @endforelse
              </ul>  
          </div>
                
          @else
          <div class="p-5"> No photos added</div>
          @endif 
        </div>
    </div>   
</section>


  <div class="row justify-content-center">
        <div class="col-lg-10  text-break bg-white shadow-lg" style="position:relative;">
          <span class="cover text-break text-truncate"><h3 class="mb-4 ">{{ $Album->title }} Album</h3>
            <em>{!! $Album->description !!}</em></span>
          @if(!empty($Album->photos))
            <div id="Album" class="border "> 
              @forelse($Album->photos as $photos)
              @if ($loop->first)
                 <div class="bg-white" style="background-image: url('{{ asset('storage/photos/'.$photos->i_image)}}');background-repeat: no-repeat;background-size: cover;">
                  <span class="p-3 text-muted"> {{-- 
                    <img class="img-thumbnail border-0 rounded-0" src="{{ asset('storage/photos/'.$photos->i_image)}}"> --}}Open family album
                  </span>
                </div>
                @elseif($loop->last)
                 <div class="bg-white" style="background-image: url('{{ asset('storage/photos/'.$photos->i_image)}}');background-repeat: no-repeat;background-size: cover;">
                  <span class="p-3 text-end text-muted"> {{-- 
                    <img class="img-thumbnail border-0 rounded-0" src="{{ asset('storage/photos/'.$photos->i_image)}}">  --}}Family album closed
                  </span>
                </div> 
                @else
                  <div class="bg-white"style="background-image: url('{{ asset('storage/photos/'.$photos->i_image)}}');background-repeat: no-repeat;background-size: cover;">
                    <span class="">{{-- 
                    <img class="img-thumbnail border-0 rounded-0" src="{{ asset('storage/photos/'.$photos->i_image)}}"> --}}
                    </span>
                  </div> 
                @endif 
                 @php
                $addmore=false; 
              @endphp
              @empty
              @php
                $addmore=true; 
              @endphp
              @endforelse
            </div>
            @else 
         
          @endif
         {{--  @if($addmore)  --}}
         {{--     <a href="{{ route('albums.settings',$Album) }}" title="Add new images" class="d-flex flex-row btn btn-sm border addmore">
                <svg class="svg-icon" viewBox="0 0 20 20">
                  <path fill="none" d="M13.68,9.448h-3.128V6.319c0-0.304-0.248-0.551-0.552-0.551S9.448,6.015,9.448,6.319v3.129H6.319
                    c-0.304,0-0.551,0.247-0.551,0.551s0.247,0.551,0.551,0.551h3.129v3.129c0,0.305,0.248,0.551,0.552,0.551s0.552-0.246,0.552-0.551
                    v-3.129h3.128c0.305,0,0.552-0.247,0.552-0.551S13.984,9.448,13.68,9.448z M10,0.968c-4.987,0-9.031,4.043-9.031,9.031
                    c0,4.989,4.044,9.032,9.031,9.032c4.988,0,9.031-4.043,9.031-9.032C19.031,5.012,14.988,0.968,10,0.968z M10,17.902
                    c-4.364,0-7.902-3.539-7.902-7.903c0-4.365,3.538-7.902,7.902-7.902S17.902,5.635,17.902,10C17.902,14.363,14.364,17.902,10,17.902
                    z"></path>
                </svg> <span class="m-1">Add more memories</span></a>
          @endif --}} 
        </div>
      </div>
 
    
@push('style') 
  <style type="text/css">
 
    h3{ 
      font-family: "Sofia", sans-serif;
    } 
  .svg-icon {
    position: relative;
  width: 2em;
  height: 2em; 
  text-align: center;
}
.svg-icon path,
.svg-icon polygon,
.svg-icon rect {
  fill: #8CC540;
}

.svg-icon circle {
  stroke:  #8CC540;
  stroke-width: 2;
}

.demo-gallery > ul {
  margin-bottom: 0;
}
.demo-gallery > ul > li {
    float: left;
    margin-bottom: 15px;
    margin-right: 20px;
    width: 200px;
}
.demo-gallery > ul > li a {  
  border-radius: 3px;
  display: block;
  overflow: hidden;
  position: relative;
  float: left;
}
.demo-gallery > ul > li a > img {
  -webkit-transition: -webkit-transform 0.15s ease 0s;
  -moz-transition: -moz-transform 0.15s ease 0s;
  -o-transition: -o-transform 0.15s ease 0s;
  transition: transform 0.15s ease 0s;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  height: 100%;
  width: 100%;
}
.demo-gallery > ul > li a:hover > img {
  -webkit-transform: scale3d(1.1, 1.1, 1.1);
  transform: scale3d(1.1, 1.1, 1.1);
}
.demo-gallery > ul > li a:hover .demo-gallery-poster > img {
  opacity: 1;
}
.demo-gallery > ul > li a .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.1);
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  -webkit-transition: background-color 0.15s ease 0s;
  -o-transition: background-color 0.15s ease 0s;
  transition: background-color 0.15s ease 0s;
}
.demo-gallery > ul > li a .demo-gallery-poster > img {
  left: 50%;
  margin-left: -10px;
  margin-top: -10px;
  opacity: 0;
  position: absolute;
  top: 50%;
  -webkit-transition: opacity 0.3s ease 0s;
  -o-transition: opacity 0.3s ease 0s;
  transition: opacity 0.3s ease 0s;
}
.demo-gallery > ul > li a:hover .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.5);
}
.demo-gallery .justified-gallery > a > img {
  -webkit-transition: -webkit-transform 0.15s ease 0s;
  -moz-transition: -moz-transform 0.15s ease 0s;
  -o-transition: -o-transform 0.15s ease 0s;
  transition: transform 0.15s ease 0s;
  -webkit-transform: scale3d(1, 1, 1);
  transform: scale3d(1, 1, 1);
  height: 100%;
  width: 100%;
}
.demo-gallery .justified-gallery > a:hover > img {
  -webkit-transform: scale3d(1.1, 1.1, 1.1);
  transform: scale3d(1.1, 1.1, 1.1);
}
.demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
  opacity: 1;
}
.demo-gallery .justified-gallery > a .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.1);
  bottom: 0;
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
  -webkit-transition: background-color 0.15s ease 0s;
  -o-transition: background-color 0.15s ease 0s;
  transition: background-color 0.15s ease 0s;
}
.demo-gallery .justified-gallery > a .demo-gallery-poster > img {
  left: 50%;
  margin-left: -10px;
  margin-top: -10px;
  opacity: 0;
  position: absolute;
  top: 50%;
  -webkit-transition: opacity 0.3s ease 0s;
  -o-transition: opacity 0.3s ease 0s;
  transition: opacity 0.3s ease 0s;
}
.demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
  background-color: rgba(0, 0, 0, 0.5);
}
.demo-gallery .video .demo-gallery-poster img {
  height: 48px;
  margin-left: -24px;
  margin-top: -24px;
  opacity: 0.8;
  width: 48px;
}
.demo-gallery.dark > ul > li a {
  border: 3px solid #04070a;
}
.home .demo-gallery {
  padding-bottom: 80px; 
}

  </style>
  <link href="https://cdn.jsdelivr.net/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">

@endpush

@push('js') 
<script>
    $(document).ready(function(){
        $('#lightgallery').lightGallery(); 
    });
</script>
<script type="text/javascript" src="{{ asset('js/imageShow.js') }}"></script>
@endpush