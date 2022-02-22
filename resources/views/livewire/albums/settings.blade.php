<div class="container-fluid"> 
<div class="row justify-content-center mt-3"> 
    <div class="col-lg-6  bg-white shadow-sm p-5"> 
        <form  method="POST"class="row" wire:submit.prevent="save">
                @csrf
                <div class="col-lg-12">
                    <div class="d-flex flex-row text-muted">
                        <div>
                           <a href="{{-- {{ url()->previous() }} --}} {{ route('albums.show',$Ablum_Id) }}"><svg class="svg-icon" viewBox="0 0 20 20">
                                <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                          </a>
                        </div>
                        <div>
                            <strong>Add photos</strong>
                        </div>
                    </div>
                    <hr>
                  </div>  
                    <span class="text-muted">Upload images</span>
                  <label for="test">
                    <div  class="div">Click or drop something here</div>
                    <input type="file" id="test" name="file" id="file" class="inputfile" wire:model.defer="photo" required>
                  </label>
                  <p id="filename"></p>
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
                      <div wire:loading wire:target="photo" id="form_pop">Loading...</div>
                      @if(!empty($photo)) 
                            @php
                                $load = false;
                                $ext = ['jpg','jpeg','png','webp','heic','heif'];
                                if ( in_array( $photo->guessExtension() ,  $ext ) ) {
                                     $load = true;
                                }
                            @endphp
                            @if($load)
                                   <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail" width="100px">
                                    @else
                                    <div class="alert alert-danger"> {{ $photo->guessExtension() }}  is an invalid filetype. An image is required.
                                    </div>
                            @endif 
                        @endif
                  </div>
                  <div class="col-lg-12"> 
                    <span class="text-muted">Caption </span>
                      <textarea class="form-control" rows="" wire:model.defer="caption" required></textarea>
                  </div> 
                  <div class="col-lg-12 mt-3 "> 
                    <button type="submit" class="btn btn-sm btn-default" wire:loading.attr="disabled">Upload Photo</button>
                 </div>
              </form> 
            </div>
            <div class="col-lg-4 ml-3 bg-white shadow-sm p-5">
                <h5>Settings</h5>
                <hr> 
                <form class="row" method="post" wire:submit.prevent="update('{{ $Ablum_Id }}')">
                    <div class="form-group">
                      <span class="text-muted">Rename</span>
                      <input type="text" class="form-control" wire:model='name' id="exampleInputname" aria-describedby="nameHelp" required>
                      <small id="nameHelp" class="form-text text-muted">Set new name to this album</small><br>
                    </div>
                    <div class="form-group">
                      <span class="text-muted">Description</span>
                      <textarea class="form-control" wire:model='description'  data-note="@this" id="note"  required></textarea>
                    </div>
                    <button type="submit" class="btn btn-default submit" wire:loading.attr="disabled" >Update</button>
                </form> 

                <form method="POST" class="row mt-4" wire:submit.prevent="deletePhoto({{ $Ablum_Id }})">
                  <button type="submit" class="btn btn-outline-danger rounded-0">Clear All photos</button>
                </form>

                 <form method="POST" class="row mt-4" wire:submit.prevent="deleteAblum({{ $Ablum_Id}})">
                    <button type="submit" class="btn btn-outline-danger rounded-0">Delete Album</button>
                </form>
          </div>
          </div>
        </div>
      @push('style')
  <style type="text/css">
.svg-icon {
  width: 1.5em;
  height: 1.5em;
}

.svg-icon path,
.svg-icon polygon,
.svg-icon rect {
  fill:#1260CC;
}

.svg-icon circle {
  stroke:#1260CC;
  stroke-width: 1;
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
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ccc;
  border: 3px dotted #bebebe;
  border-radius: 10px;
}

label {
  display: inline-block;
  position: relative;
  height: 100px;
  width: 400px;
}

.div.dragover {
  background-color: #aaa;
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
            eval(note).set('description',editor.getData());
          });
          
         
        })
        .catch( error => {
            console.error( error );
        } );
    </script> 

@endpush