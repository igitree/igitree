<div class="container text-left ">
    <div class="row mt-4">
        <div class="col-lg-4 card p-3 shadow-sm border-0">
             <form  method="POST"class="row" wire:submit.prevent="save">
              @csrf
              <div class="col-lg-12 text-muted">
                  <div class="d-flex flex-row">
                      <div class="flex-grow-1">
                         <h5> Add Stories</h5>
                      </div>
                      <div wire:click.prevent="resetForm">
                          @
                      </div>
                  </div>
                  <hr>
                </div>
                <div class="col-lg-12">
                    <div class="d-flex flex-row">
                        <div class="flex-fill">
                            <input type="Radio" wire:click.prevent="useText"> Add Text  
                        </div>

                        <div class="flex-fill">
                            <input type="Radio" wire:click.prevent="UseIMage"> Add Image  
                        </div>
                    </div>  
                </div>
               @if($useText)
                <div class="col-lg-12 mt-4 p-2" wre:ignore> 
                <strong>Add Text</strong>  
                    <textarea id="note" data-note="@this" wire:model.defer="s_text" class="form-control"></textarea>
                </div> 
                @elseif($UseIMage)
                <div class="col-lg-12 mt-3"> 
                    <strong>Add  images</strong> 
                    <label for="test">
                      <div  class="div">Click or drop something here</div>
                      <input type="file" id="test" name="file" id="file" class="inputfile" wire:model.defer="s_photo">
                    </label>
                    <p id="filename"></p>
                      @error('photo') <span class="error">{{ $message }}</span> @enderror 
                </div> 
                @elseif($UseIMage==null and $useText==null)
                     <div class="col-lg-12 mt-4 p-2" wre:ignore> 
                        <strong>Add Text</strong>  
                            <textarea id="note" data-note="@this" wire:model.defer="s_text" class="form-control"></textarea>
                        </div> 
                        <div class="col-lg-12 mt-3"> 
                            <strong>Add  images</strong> 
                            <label for="test">
                              <div  class="div">Click or drop something here</div>
                              <input type="file" id="test" name="file" id="file" class="inputfile" wire:model.defer="s_photo">
                            </label>
                            <p id="filename"></p>
                              @error('photo') <span class="error">{{ $message }}</span> @enderror 
                        </div> 
                @endif
                  <script type="text/javascript">
                    var fileInput = document.querySelector('input[type=file]');
                    var filenameContainer = document.querySelector('#filename');
                    var dropzone = document.querySelector('.div');

                    fileInput.addEventListener('change', function() {
                      filenameContainer.innerText = fileInput.value.split('\\').pop();
                    });

                    fileInput.addEventListener('dragenter', function() {
                      dropzone.classList.add('dragover');
                    });

                    fileInput.addEventListener('dragleave', function() {
                      dropzone.classList.remove('dragover');
                    });

                  </script>
                  <div class="col-lg-12">
                      <div wire:loading wire:target="s_photo" id="form_pop">Loading...</div>
                      @if(!empty($s_photo)) 
                            @php
                                $load = false;
                                $ext = ['jpg','jpeg','png','webp','heic','heif'];
                                if ( in_array( $s_photo->guessExtension() ,  $ext ) ) {
                                     $load = true;
                                }
                            @endphp
                            @if($load)
                                   <img src="{{ $s_photo->temporaryUrl() }}" class="img-thumbnail" width="100px">
                                    @else
                                    <div class="alert alert-danger"> {{ $s_photo->guessExtension() }}  is an invalid filetype. An image is required.
                                    </div>
                            @endif 
                        @endif
                  </div> 
                  <div class="col-lg-12 mt-3 "> 
                    <button type="submit" class="btn btn-sm btn-default submit" wire:loading.attr="disabled">Add story</button>
                 </div> 
              </form> 
        </div>
        <div class="col-lg-8 mt-3" wire:ignore> 
            @if(!empty($status))
             @forelse ($this->status as $stat => $user) 
              @php
                $userDetails=\App\Models\User::where('u_id',$stat)->get()->first();
              @endphp
                  <small>{{ $userDetails->u_fullname }}'s Stories</small><br>
                  <div class="row">
                     @forelse($user as $data) 
                        @if($data) 
                            <a id="content_1" class="col-3 col-lg-2 col-md-2 col-sm-3 col-xs-2 tabcontent story-area" href="{{route('status.show',$stat)}}"> 
                                <div class="story-container-1 "> 
                                    <div class="single-story shadow">
                                      @if(!empty($data->s_image))
                                          <img src="{{ asset('storage/status/'.$data->s_image)}}" class="single-story-bg">

                                      @else  
                                      @endif 
                                        <div class="story-author text-break mt-5"> 
                                            @if($diffHours >= 24)
                                               @php
                                                $Status=\App\Models\Status::where('s_id',$data->s_id);
                                                $Status->delete(); 
                                               @endphp
                                            @else
                                            <p>{{$userDetails->u_fullname }} <br><small>
                                            Story posted {{$diffHours}} hrs ago</small></p>
                                            @endif 
                                        </div> 
                                    </div>
                                  </div>
                                </a> 
                        @endif
                          @empty
                     @endforelse
                   </div>
             @empty
             <div class="p-4 text-muted "><h5>No stories</h5></div>
             @endforelse 
             @else
             <div class="p-4 text-muted "><h5>No stories</h5></div>
             @endif         
        </div>
    </div>
</div>

@push('style')
    <style type="text/css">
.widget {
    padding: 0;
    margin-top: 0;
    margin-bottom: 0;
    border-radius: 6px;
    -webkit-box-shadow: 0 4px 6px 0 rgb(85 85 85 / 8%), 0 1px 20px 0 rgb(0 0 0 / 7%), 0px 1px 11px 0px rgb(0 0 0 / 7%);
    -moz-box-shadow: 0 4px 6px 0 rgba(85, 85, 85, 0.08), 0 1px 20px 0 rgba(0, 0, 0, 0.07), 0px 1px 11px 0px rgba(0, 0, 0, 0.07);
    box-shadow: 0 4px 6px 0 rgb(85 85 85 / 8%), 0 1px 20px 0 rgb(0 0 0 / 7%), 0px 1px 11px 0px rgb(0 0 0 / 7%);
}
.widget.box .widget-header {
    background: #fff;
    padding: 0px 8px 0px;
    border-top-right-radius: 6px;
    border-top-left-radius: 6px;
}
.widget .widget-header {
    border-bottom: 0px solid #f1f2f3;
}
.widget.box .widget-header {
    background: #fff;
    padding: 0px 8px 0px;
    border-top-right-radius: 6px;
    border-top-left-radius: 6px;
}
.widget .widget-header {
    border-bottom: 0px solid #f1f2f3;
}
.widget .widget-header:after {
    clear: both;
}
.widget .widget-header:before, .widget .widget-header:after {
    display: table;
    content: "";
    line-height: 0;
}
.widget-content-area {
    padding: 20px;
    position: relative;
    background-color: #fff;
    border-bottom-left-radius: 6px;
    border-bottom-right-radius: 6px;
}
 
.story-container-1 .single-story {
    height: 175px;
    width:100%;
    border-radius: 10px;
    overflow: hidden;
    position: relative;
    margin-right: 0px;
    margin-bottom: 10px;
}
.story-container-1 .single-story::before {
    content: "";
    position: absolute;
    top: 0;
    bottom: 0;
    right: 0;
    left: 0;
    background-image: linear-gradient(rgb(255 0 0 / 0%), black);
}
img.single-story-bg {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.story-container-1 .story-author {
    position: absolute;
    top: 50%;
    left: 0px;
    transform: translateY(-50%);
    right: 0px;
    text-align: center;
    z-index: 99;
    cursor: pointer;
}

.story-author img {
    height: 60px;
    width: 60px;
    border-radius: 50%;
    border: 1px solid white;
    padding: 4px;
}

.story-container-1 .story-author p {
    color: #fff;
    width: 100%;
    margin: 5px 0px 0px 0px;
    font-weight: 600;
    font-size: 12px;
}

.create-story-author p {
    margin: 0px;
    font-size: 13px;
    font-weight: 500;
}




input[type="file"] {
  position: absolute;
  left: 0;
  opacity: 0;
  top: 0;
  bottom: 0; 
  width: 100%;
}

.div {
  position: absolute;
  top: 0;
  bottom: 0; 
  width: ;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ccc;
  border: 3px dotted #bebebe;
  border-radius: 10px;
  min-width:40%;
}

label {
  display: inline-block;
  position: relative;
  height: 100px;
  width: 800px;
}

.div.dragover {
  background-color: #aaa;
  width: 100%;
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
            eval(note).set('s_text',editor.getData());
          });
          
         
        })
        .catch( error => {
            console.error( error );
        } );
    </script> 
@endpush

























