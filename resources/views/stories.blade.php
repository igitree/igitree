<!doctype html>
<html ⚡>
  <head>
    <meta charset="utf-8">   
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Igitree') }}</title> 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
    <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
    <script async src="https://cdn.ampproject.org/v0.js"></script>
    <script async custom-element="amp-video"
        src="https://cdn.ampproject.org/v0/amp-video-0.1.js"></script>
    <script async custom-element="amp-story"
        src="https://cdn.ampproject.org/v0/amp-story-1.0.js"></script> 
    <style amp-custom>
      amp-story {
        font-family: 'Oswald',sans-serif;
        color: #fff;
      }
      amp-story-page {
        background-color: #000;
      }
      h4 {
        font-weight: bold;
        font-size: 2.875em;
        font-weight: normal;
        line-height: 1.174;
      }
      p {
        font-weight: normal;
        font-size: 1.3em;
        line-height: 1.5em;
        color: #fff;
      }
      q {
        font-weight: 300;
        font-size: 1.1em;
      }
      amp-story-grid-layer.bottom {
        align-content:end;
      }
      amp-story-grid-layer.noedge {
        padding: 0px;
      }
      amp-story-grid-layer.center-text {
        align-content: center;
      }
      .wrapper {
        display: grid;
        grid-template-columns: 50% 50%;
        grid-template-rows: 50% 50%;
      }
      .banner-text {
        text-align: center;
        background-color: #000;
        line-height: 2em;
      }
    </style>
  </head>
  <body>
    <!-- Cover page -->
    <amp-story standalone
        title="Joy of Pets"
        publisher="AMP tutorials"
        publisher-logo-src="{{asset('assets/assets/AMP-Brand-White-Icon.svg')}}"
        poster-portrait-src="{{asset('assets/assets/cover.jpg')}}">

         @if(!empty($Status))
            @forelse($Status as $stat) 
                @if(!empty($stat->s_image)) 
                    <amp-story-page id="page1">
                      <amp-story-grid-layer template="fill">
                        <amp-img src="{{asset('storage/status/'.$stat->s_image)}}" 
                            width="720" height="1280"
                            layout="responsive">
                        </amp-img>
                      </amp-story-grid-layer> 
                    </amp-story-page>
                  @elseif(!empty($stat->s_text))
                  <amp-story-page id="page1"> 
                       <amp-story-grid-layer template="fill">
                       </amp-story-grid-layer>
                        <amp-story-grid-layer template="thirds">
                          <h6 grid-area="upper-third">Story</h6>
                          <p grid-area="lower-third">{!! $stat->s_text !!}</p>
                      </amp-story-grid-layer>
                    </amp-story-page>

                  @elseif(!empty($stat->s_text) and !empty($stat->s_image))
                    <amp-story-page id="page1">
                      <amp-story-grid-layer template="fill">
                        <amp-img src="{{asset('storage/status/'.$stat->s_image)}}" 
                            width="720" height="1280"
                            layout="responsive">
                        </amp-img>
                      </amp-story-grid-layer>
                        <amp-story-grid-layer template="thirds">
                          <h6 grid-area="upper-third">Story</h6>
                          <p grid-area="lower-third">{!! $stat->s_text !!}</p>
                      </amp-story-grid-layer>
                    </amp-story-page> 
{{-- 
                  @elseif(!empty($stat->s_video))
                    <amp-story-page id="page1">
                      <amp-story-grid-layer template="fill">
                        <amp-video autoplay loop
                              width="720" height="1280"
                              poster="assets/rabbit.jpg"
                              layout="responsive">
                            <source src="{{asset('storage/status/'.$stat->s_video)}}" type="video/mp4">
                        </amp-video>
                      </amp-story-grid-layer>
                    </amp-story-page>
 --}}
                @else
                    <amp-story-page  id="page1"> 
                      <amp-story-grid-layer template="vertical">
                        <h4>Igitree</h4>
                        <a href="{{route('status')}}" class="btn btn-sm btn-success">Go to back</a>
                      </amp-story-grid-layer>
                      <amp-story-grid-layer template="vertical" class="bottom">
                        No more stories
                      </amp-story-grid-layer>
                    </amp-story-page>
                @endif 
              @empty
          @endforelse
          <amp-story-page  id="page1"> 
              <amp-story-grid-layer template="vertical">
                <h4>Igitree</h4>
                <a href="{{route('status')}}" class="btn btn-sm btn-success">Go to back</a>
              </amp-story-grid-layer>
              <amp-story-grid-layer template="vertical" class="bottom">
                No more stories
              </amp-story-grid-layer>
            </amp-story-page>
        @endif  
    </amp-story>
  </body>
</html>
