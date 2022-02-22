<div class="container mt-3">
    <div class="panel messages-panel shadow-sm text-left">
        
        <div class="tab-content">
            <div class="tab-pane message-body active" id="inbox-message-1">
                <div class="message-top"> 
                    <div class="d-flex flex-row p-2 ml-3">
                        <a href="{{ route('chat') }}" title="Back to chat" class="backButton  btn-sm btn-" style="text-align:left; font-size:20px;">  
                            <svg class="svg-icon" viewBox="0 0 20 20">
                                <path fill="none" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
                            </svg>
                        </a>
                        @if($userReceiverSendMessage)
                        <div>
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                @if(!empty($userReceiverSendMessage->profile_photo_path)) 
                                    <img alt="{{ $userReceiverSendMessage->u_fullname }}"  class="img-circle medium-image" src="{{asset('storage/'.$userReceiverSendMessage->profile_photo_path)}}" />
                                @else
                                    <img alt="" class=" medium-image border-0 bg-none" src="{{asset('/assets/img/account.jpg')}}">
                                @endif
                            @else 
                                <img alt="" class=" medium-image border-0 bg-none" src="{{asset('/assets/img/account.jpg')}}">
                            @endif
                        </div>
                        <div class="flex-grow-1 d-flex flex-column ">
                            <div>
                               {{ $userReceiverSendMessage->u_fullname}}
                            </div>
                            <div>
                               <small>{{$userReceiverSendMessage->u_email}}</small> 
                            </div>
                            
                        </div>
                        <div>  
                            <div class="btn-group dropstart" wire:ignore>
                                <button type="button" class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M3.936,7.979c-1.116,0-2.021,0.905-2.021,2.021s0.905,2.021,2.021,2.021S5.957,11.116,5.957,10
                                        S5.052,7.979,3.936,7.979z M3.936,11.011c-0.558,0-1.011-0.452-1.011-1.011s0.453-1.011,1.011-1.011S4.946,9.441,4.946,10
                                        S4.494,11.011,3.936,11.011z M16.064,7.979c-1.116,0-2.021,0.905-2.021,2.021s0.905,2.021,2.021,2.021s2.021-0.905,2.021-2.021
                                        S17.181,7.979,16.064,7.979z M16.064,11.011c-0.559,0-1.011-0.452-1.011-1.011s0.452-1.011,1.011-1.011S17.075,9.441,17.075,10
                                        S16.623,11.011,16.064,11.011z M10,7.979c-1.116,0-2.021,0.905-2.021,2.021S8.884,12.021,10,12.021s2.021-0.905,2.021-2.021
                                        S11.116,7.979,10,7.979z M10,11.011c-0.558,0-1.011-0.452-1.011-1.011S9.442,8.989,10,8.989S11.011,9.441,11.011,10
                                        S10.558,11.011,10,11.011z"></path>
                                    </svg>
                                </button>
                              <ul class="dropdown-menu">
                                <li>
                                    <form wire:submit.prevent="deleteAllMessage('{{ $userReceiverSendMessage->u_id }}')">
                                        <button class=" btn-danger dropdown-item " href="#"> Delete Messages</button>
                                    </form>
                                </li> 
                              </ul>
                                </div>
                            </div>
                        @else
                        <div>
                            Unkown User
                        </div>
                        @endif
                    </div> 
                </div> 
                <div class="message-chat" style="position: relative;">
                    <div class="chat-body text-center text-muted" wire:poll="messages"> 
                          @foreach ($messages as $day => $message_list)
                                
                                <small>{{ $day }} {{-- : {{ $message_list->count() }} --}}</small>
                               
                                @forelse($message_list as $message) 
                                    <div class="message text-break {{ auth()->user()->u_id == $message->c_sender ? 'my-message':''}} ">
                                        @php
                                            $userDetails=\App\Models\User::where('u_id',$message->c_sender)->get()->first();
                                        @endphp 
                                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                             @if(!empty($userDetails->profile_photo_path)) 
                                                 <img alt="{{ $userDetails->u_fullname }}"  class="img-circle medium-image" src="{{asset('storage/'.$userDetails->profile_photo_path)}}"/>
                                             @else
                                                <img alt="" class="img-circle medium-image" alt="{{ $userDetails->u_fullname }}"  src="{{asset('/assets/img/account.jpg')}}"/>
                                             @endif
                                           

                                        @else 
                                          <img alt="" class="img-circle medium-image" alt="{{ $users->u_fullname }}"  src="{{asset('/assets/img/account.jpg')}}"/>
                                        @endif 

                                        <div class="message-body"> 
                                            <div class="{{!empty($message->c_image) ? 'message-info d-flex flex-row pb-1 pr-1' : ''}}  ">   
                                                @if(!empty($message->c_image))
                                                    <a href="{{ asset('storage/photos/'.$message->c_image)}}" title="Save Image" download><svg class="svg-icon" viewBox="0 0 20 20">
                                                        <path fill="none" d="M15.608,6.262h-2.338v0.935h2.338c0.516,0,0.934,0.418,0.934,0.935v8.879c0,0.517-0.418,0.935-0.934,0.935H4.392c-0.516,0-0.935-0.418-0.935-0.935V8.131c0-0.516,0.419-0.935,0.935-0.935h2.336V6.262H4.392c-1.032,0-1.869,0.837-1.869,1.869v8.879c0,1.031,0.837,1.869,1.869,1.869h11.216c1.031,0,1.869-0.838,1.869-1.869V8.131C17.478,7.099,16.64,6.262,15.608,6.262z M9.513,11.973c0.017,0.082,0.047,0.162,0.109,0.226c0.104,0.106,0.243,0.143,0.378,0.126c0.135,0.017,0.274-0.02,0.377-0.126c0.064-0.065,0.097-0.147,0.115-0.231l1.708-1.751c0.178-0.183,0.178-0.479,0-0.662c-0.178-0.182-0.467-0.182-0.645,0l-1.101,1.129V1.588c0-0.258-0.204-0.467-0.456-0.467c-0.252,0-0.456,0.209-0.456,0.467v9.094L8.443,9.553c-0.178-0.182-0.467-0.182-0.645,0c-0.178,0.184-0.178,0.479,0,0.662L9.513,11.973z"></path>
                                                    </svg>
                                                 </a>
                                                 @elseif(!empty($message->c_document))
                                                     <a href="{{ asset('storage/photos/'.$message->c_document)}}" title="Save Image" download><svg class="svg-icon" viewBox="0 0 20 20">
                                                        <path fill="none" d="M15.608,6.262h-2.338v0.935h2.338c0.516,0,0.934,0.418,0.934,0.935v8.879c0,0.517-0.418,0.935-0.934,0.935H4.392c-0.516,0-0.935-0.418-0.935-0.935V8.131c0-0.516,0.419-0.935,0.935-0.935h2.336V6.262H4.392c-1.032,0-1.869,0.837-1.869,1.869v8.879c0,1.031,0.837,1.869,1.869,1.869h11.216c1.031,0,1.869-0.838,1.869-1.869V8.131C17.478,7.099,16.64,6.262,15.608,6.262z M9.513,11.973c0.017,0.082,0.047,0.162,0.109,0.226c0.104,0.106,0.243,0.143,0.378,0.126c0.135,0.017,0.274-0.02,0.377-0.126c0.064-0.065,0.097-0.147,0.115-0.231l1.708-1.751c0.178-0.183,0.178-0.479,0-0.662c-0.178-0.182-0.467-0.182-0.645,0l-1.101,1.129V1.588c0-0.258-0.204-0.467-0.456-0.467c-0.252,0-0.456,0.209-0.456,0.467v9.094L8.443,9.553c-0.178-0.182-0.467-0.182-0.645,0c-0.178,0.184-0.178,0.479,0,0.662L9.513,11.973z"></path>
                                                    </svg>
                                                 </a>
                                                @endif
                                            </div> 
                                            <div class="message-text mb-0"> 
                                                @if(!empty($message->c_message) and $message->c_message!='null' and empty($message->c_image)  ) 
                                                     {{ $message->c_message }}<br>
                                                @elseif(!empty($message->c_image) and $message->c_message == 'null' or $message->c_message=='' or $message->c_image !=null )  
                                                <div class="demo-gallery ">
                                                    <ul id="lightgallery" class="list-unstyled" style="width: fit-content;"> 
                                                        <li class="col-lg-12" data-responsive="{{ asset('storage/photos/'.$message->c_image)}}" data-src="{{ asset('storage/photos/'.$message->c_image)}}" data-sub-html="<h4>{{ 'igitree image' }}</h4>">
                                                            <a href=""> 
                                                                <img class="img-thumbnail border-0" src="{{ asset('storage/photos/'.$message->c_image)}}" alt="image" > 
                                                            </a>
                                                        </li> 
                                                      </ul>  
                                                  </div> 

                                                  @elseif(!empty($message->c_document))  
                                                    <p class="alert-success rounded p-2 text-truncate" style="width:200px;position: relative;font-size: 12px;"> 
                                                        <svg class="svg-icon" viewBox="0 0 20 20">
                                                                <path fill="none" d="M17.222,5.041l-4.443-4.414c-0.152-0.151-0.356-0.235-0.571-0.235h-8.86c-0.444,0-0.807,0.361-0.807,0.808v17.602c0,0.448,0.363,0.808,0.807,0.808h13.303c0.448,0,0.808-0.36,0.808-0.808V5.615C17.459,5.399,17.373,5.192,17.222,5.041zM15.843,17.993H4.157V2.007h7.72l3.966,3.942V17.993z"></path>
                                                                <path fill="none" d="M5.112,7.3c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808c0-0.447-0.363-0.808-0.808-0.808H5.92C5.475,6.492,5.112,6.853,5.112,7.3z"></path>
                                                                <path fill="none" d="M5.92,5.331h4.342c0.445,0,0.808-0.361,0.808-0.808c0-0.446-0.363-0.808-0.808-0.808H5.92c-0.444,0-0.808,0.361-0.808,0.808C5.112,4.97,5.475,5.331,5.92,5.331z"></path>
                                                                <path fill="none" d="M13.997,9.218H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,9.58,14.442,9.218,13.997,9.218z"></path>
                                                                <path fill="none" d="M13.997,11.944H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,12.306,14.442,11.944,13.997,11.944z"></path>
                                                                <path fill="none" d="M13.997,14.67H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.447,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,15.032,14.442,14.67,13.997,14.67z"></path>
                                                            </svg>
                                                        <label class="text-truncate" style="position: absolute;top: 8px;left:30px;">{{$message->c_document}}
                                                        </label> 
                                                    </p>

                                                  @elseif(!empty($message->c_image) and $message->c_message != 'null' or $message->c_message !='' or $message != null)
                                                    <div class="demo-gallery" style="position:relative;">
                                                        <ul id="lightgallery" class=" list-unstyled  "> 
                                                            <li class="col-lg-12" data-responsive="{{ asset('storage/photos/'.$message->c_image)}}" data-src="{{ asset('storage/photos/'.$message->c_image)}}" data-sub-html="<h4>{{ 'igitree image' }}</h4> <p>{{ $message->c_message }}</>">
                                                                <a href=""> 
                                                                    <img class="img-thumbnail border-0" src="{{ asset('storage/photos/'.$message->c_image)}}" alt="image" > 
                                                                </a>
                                                            </li> 
                                                          </ul>   
                                                    </div>
                                                     {{ $message->c_message }} 
                                                @endif
                                                @if($message->c_sender == auth()->user()->u_id)
                                                <div  class="Actions text-danger bg-light shadow-sm">
                                                    <form method="POST" class=" justify-content-between d-flex flex-row" wire:submit.prevent="deleteMessage('{{ $message->c_id }}')">
                                                        <button title="Delete" class="  btn btn-sm text-danger"><i class="fa fa-trash" ></i><small>Delete</small></button> 
                                                    </form> 
                                                </div> 
                                                @endif     
                                                <small>{{  \Carbon\Carbon::parse($message->c_date)->format('H:m:i')}}</small>
                                            </div> 
                                        </div>
                                        <br>
                                    </div>
                                @empty
                                <x-noMessages/>
                            @endforelse
                            @endforeach   
                    </div> 
                    <form class="chat-footer" method="POST" wire:submit.prevent="SendMessage" style="position:relative;" wire:keydown.enter="SendMessage" wire:ignore>
                        <div class="preview-container" style="position:absolute;top: -90px;padding: 3px;">

                        @if(!empty($photo)) 
                            @php
                                $load = false;
                                $ext = ['jpg','jpeg','png','webp','heic','heif'];
                                if ( in_array( $photo->guessExtension() ,  $ext ) ) {
                                     $load = true;
                                }
                            @endphp
                            @if($load)
                            <p class="alert-success rounded p-2" style="width: 200px;position: relative;font-size: 12px;"> 
                                  <img src="{{ $photo->temporaryUrl() }}" class="img-thumbnail"> 
                            <label style="
                            position: absolute;top: 0px;right:-10px;border-radius: 50%;cursor: pointer;" class="text-white pl-1 pr-1 bg-danger" title="Remove this image" wire:click="removeitem">X</label>
                            </p>
                                    @else
                                    <div class="alert alert-danger"> {{ $photo->guessExtension() }}  is an invalid filetype. An image is required.
                                    </div>
                            @endif 
                        @endif
                        @if(!empty($document))
                              @php
                                $loaded = false;
                                $extx = ['pdf','doc','docx','html','htm','xls','xlsx','txt','sql'];
                                if ( in_array( $document->guessExtension() ,  $extx ) ) {
                                     $loaded = true;
                                }
                            @endphp
                            @if($loaded) 
                        <p class="alert-success rounded p-2" style="width: 100px;position: relative;font-size: 12px;"> 
                            <svg class="svg-icon" viewBox="0 0 20 20">
                                    <path fill="none" d="M17.222,5.041l-4.443-4.414c-0.152-0.151-0.356-0.235-0.571-0.235h-8.86c-0.444,0-0.807,0.361-0.807,0.808v17.602c0,0.448,0.363,0.808,0.807,0.808h13.303c0.448,0,0.808-0.36,0.808-0.808V5.615C17.459,5.399,17.373,5.192,17.222,5.041zM15.843,17.993H4.157V2.007h7.72l3.966,3.942V17.993z"></path>
                                    <path fill="none" d="M5.112,7.3c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808c0-0.447-0.363-0.808-0.808-0.808H5.92C5.475,6.492,5.112,6.853,5.112,7.3z"></path>
                                    <path fill="none" d="M5.92,5.331h4.342c0.445,0,0.808-0.361,0.808-0.808c0-0.446-0.363-0.808-0.808-0.808H5.92c-0.444,0-0.808,0.361-0.808,0.808C5.112,4.97,5.475,5.331,5.92,5.331z"></path>
                                    <path fill="none" d="M13.997,9.218H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,9.58,14.442,9.218,13.997,9.218z"></path>
                                    <path fill="none" d="M13.997,11.944H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.446,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,12.306,14.442,11.944,13.997,11.944z"></path>
                                    <path fill="none" d="M13.997,14.67H5.92c-0.444,0-0.808,0.361-0.808,0.808c0,0.447,0.363,0.808,0.808,0.808h8.077c0.445,0,0.808-0.361,0.808-0.808C14.805,15.032,14.442,14.67,13.997,14.67z"></path>
                                </svg>
                            <label style="position: absolute;top: 8px;right:4px;">Docs is ready
                            </label>
                            <label style="
                            position: absolute;top: 0px;right:-10px;border-radius: 50%;cursor: pointer;" class="text-white pl-1 pr-1 bg-danger" title="Remove this docs" wire:click="removeitem">X</label>
                        </p>
                        @else
                                <div class="alert alert-danger"> {{ $document->guessExtension() }}  is an invalid filetype. A document is required.
                                </div>
                            @endif 
                        @endif

                            <div wire:loading  wire:target="SendMessage">
                                <small>Sending...</small>
                            </div>
                            <div wire:loading wire:target="photo"><small>Uploading image...</small></div>
                            <div wire:loading wire:target="document"><small>Uploading docs...</small></div>
                            @error('photo') <span class="alert alert-danger  ">{{ $message }}</span> @enderror
                        </div> 
                        <textarea class="send-message-text" class="form-control" placeholder="Type message here..." wire:model.defer="userInpuMessage" id="{{-- emojionearea1 --}}" autofocus ></textarea>
                        <label class="upload-file">
                            <input type="file" wire:model.defer="document" name="document">
                            <i class="fa fa-paperclip"></i>
                        </label>
                         <label class="upload-file mr-5">
                            <input type="file" wire:model.defer="photo">
                            <i class="fa fa-image"></i>
                        </label>
                        <div class="sending-button">
                         <button type="submit"  class="btn btn-sm btn-default " wire:loading.attr="disabled" wire:target="photo" wire:target="document"> Send <i class="fa fa-send"></i> </button>
                        </div>
                    </form>  
                </div>
            </div>  
        </div>
    </div>
</div> 
@push('style')
<link rel="stylesheet" href="{{ asset('emojis/dist/emojionearea.min.css') }}">
    <style type="text/css">

.noMessageSelected{
    font-size:30px;
    position: absolute;
    left: 40%;
    top: -90px;
    margin-top: 30%;
    color: #1260CC; 
}

.Actions i{
    font-size: 17px; 
    cursor: pointer;

}

.Actions {
    position: absolute; 
    bottom: 0;
    left: 0;
    width:100%; 
    display: none;  
}

.svg-icon {
  width: 1.5em;
  height: 1.5em;
}

.svg-icon path,
.svg-icon polygon,
.svg-icon rect {
  fill: #1260CC;
}

.svg-icon circle {
  stroke: #1260CC;
  stroke-width: 1;
}
.sending-button{
    position: absolute;
    right: 0px;
    bottom: 15px;
}

.noMessageSelected{
    font-size:30px;
    position: absolute;
    left: 40%;
    margin-top: 30%;
    color: #1260CC;
} 
.borderlist{
    margin-top:1px ;/*
    border:1px solid  #1260CC;;*/
}
.contacts li > .info-combo > h3.name{
    font-size:12px;    
}
h3.name{
    font-size:17px;
    margin-top: 10px;    
}
.contacts li{
    cursor: pointer;
}
.contacts li .message-time {
    text-align: right;
    display: block;
    margin-left: -15px;
    width: 30px;
    height: 25px;
    line-height: 28px;
    font-size: 12px;
    font-weight: 600;
    padding-right: 5px;
}
.contacts li > .info-combo > h5 {
    width: 180px;
    font-size: 12px;
    height: 28px;
    font-weight: 500;
    overflow: hidden;
    white-space: normal;
    text-overflow: ellipsis;
}

.contacts li > .info-combo > h3 {
    width: 167px;
    height: 20px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

.info-combo > h3 {
    margin: 3px 0;
}

.no-margin-bottom {
    margin-bottom: 0 !important;
}

.info-combo > h5 {
    margin: 2px 0 6px 0;
}
/* Messages */
.messages-panel img.img-circle {
    border: 1px solid rgba(0,0,0,0.1);
}

.medium-image {
    width: 45px;
    height: 45px;
    margin-right: 5px;
}

.img-circle {
    border-radius: 50%;
}
.messages-panel {
  width: 100%;
  height: calc(100vh - 150px);
  min-height: 460px;
  background-color: #fbfcff;
  display: inline-block;
  border-top-left-radius: 5px;
  margin-bottom: 0;
}

.messages-panel img.img-circle {
  border: 1px solid rgba(0,0,0,0.1);
}

.messages-panel .tab-content {
  border: none;
  background-color: transparent;
}

.contacts-list {
  background-color: #fff;
  border-right: 1px solid #cfdbe2;
  width: 305px;
  height: 100%;
  border-top-left-radius: 5px;
  float: left;
}

.contacts-list .inbox-categories {
  width: 100%;
  padding: 0;
  margin-left: 0;
}

.contacts-list .inbox-categories > div {
  float: left;
  width: 76px;
  padding: 15px 5px;
  font-size: 14px;
  text-align: center;
  border-right: 1px solid rgba(0,0,0,0.1);
  background-color: rgba(255,255,255,0.75);
  cursor: pointer;
  font-weight: 700;
}

.contacts-list .inbox-categories > div:nth-child(1) {
  color: #1260CC;
  border-right-color: rgba(45,129,233,0.06);
  border-bottom: 4px solid #1260CC;
  border-top-left-radius: 5px;
}

.contacts-list .inbox-categories > div:nth-child(1).active {
  color: #fff;
  background-color: #1260CC;
  border-bottom: 4px solid rgba(0,0,0,0.15);
}

.contacts-list .inbox-categories > div:nth-child(2) {
  color: #0ec8a2;
  border-right-color: rgba(14,200,162,0.06);
  border-bottom: 4px solid #0ec8a2;
}

.contacts-list .inbox-categories > div:nth-child(2).active {
  color: #fff;
  background-color: #0ec8a2;
  border-bottom: 4px solid rgba(0,0,0,0.15);
}

.contacts-list .inbox-categories > div:nth-child(3) {
  color: #ff9e2a;
  border-right-color: rgba(255,152,14,0.06);
  border-bottom: 4px solid #ff9e2a;
}

.contacts-list .inbox-categories > div:nth-child(3).active {
  color: #fff;
  background-color: #ff9e2a;
  border-bottom: 4px solid rgba(0,0,0,0.15);
}

.contacts-list .inbox-categories > div:nth-child(4) {
  color: #314557;
  border-bottom: 4px solid #314557;
  border-right-color: transparent;
}

.contacts-list .inbox-categories > div:nth-child(4).active {
  color: #fff;
  background-color: #314557;
  border-bottom: 4px solid rgba(0,0,0,0.35);
}

.contacts-list .panel-search > input {
  margin-left: 5px;
  background-color: rgba(0,0,0,0);
}

input[type=search]{
    background-color: #1260CC;
    color: white;
}

input[type=search]:focus{
   background-color: #1260CC;
    color:white; 
}

.contacts-outter-wrapper {
  position: relative;
  width: 305px;
  direction: rtl;
  min-height: 405px;
  overflow: hidden;
}

.contacts-outter-wrapper:after, .contacts-outter-wrapper:nth-child(1):after {
  content: "";
  position: absolute;
  width: 100%;
  height: 5px;
  bottom: 0;
  background-color: #1260CC;
  border-bottom-left-radius: 4px;
}

.contacts-outter-wrapper:nth-child(2):after {
  background-color: #0ec8a2;
}

.contacts-outter-wrapper:nth-child(3):after {
  background-color: #ff9e2a;
}

.contacts-outter-wrapper:nth-child(4):after {
  background-color: #314557;
}

.contacts-outter {
  position: relative;
  height: calc(100vh - 278px);
  width: 325px;
  direction: rtl;
  overflow-y: scroll;
  padding-left: 20px;
}

@media screen and (min-color-index:0) and(-webkit-min-device-pixel-ratio:0) {
  @media {
    .contacts-outter-wrapper {
      direction: ltr;
    }

    .contacts-outter{
      direction: ltr;
      padding-left: 0;
    }
  }
}

.contacts {
  direction: ltr;
  width: 305px;
  margin-top: 0px;
}

.contacts li {
  width: 100%;
  border-top: 1px solid transparent;
  border-bottom: 1px solid rgba(205,211,237,0.2);
  border-left: 4px solid rgba(255,255,255,0);
  padding: 8px 12px;
  position: relative;
  background-color: rgba(255,255,255,0);
}

.contacts li:first-child {
  border-top: 1px solid rgba(205,211,237,0.2);
}

.contacts li:first-child.active {
  border-top: 1px solid rgba(205,211,237,0.75);
}

.contacts li:hover {
  background-color: rgba(255,255,255,0.25);
}

.contacts li.active, .contacts.info li.active {
  border-left: 4px solid #1260CC;
  border-top-color: rgba(205,211,237,0.75);
  border-bottom-color: rgba(205,211,237,0.75);
  background-color: #fbfcff;
}

.contacts.success li.active {
  border-left: 4px solid #0ec8a2;
}

.contacts.warning li.active {
  border-left: 4px solid #ff9e2a;
}

.contacts.danger li.active {
  border-left: 4px solid #f95858;
}

.contacts.dark li.active {
  border-left: 4px solid #314557;
}

.contacts li > .info-combo {
  width: 172px;
  cursor: pointer;
}

.contacts li > .info-combo > h3 {
  width: 167px;
  height: 20px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
}

.contacts li .contacts-add {
  width: 50px;
  float: right;
  z-index: 23299;
}

.contacts li .message-time {
  text-align: right;
  display: block;
  margin-left: -15px;
  width: 70px;
  height: 25px;
  line-height: 28px;
  font-size: 12px;
  font-weight: 600;
  padding-right: 5px;
}

.contacts li .contacts-add .fa-trash-o {
  position: absolute;
  font-size: 14px;
  right: 12px;
  bottom: 15px;
  color: #a6a6a6;
  cursor: pointer;
}

.contacts li .contacts-add .fa-paperclip {
  position: absolute;
  font-size: 14px;
  right: 34px;
  bottom: 15px;
  color: #a6a6a6;
  cursor: pointer;
}

.contacts li .contacts-add .fa-trash-o:hover {
  color: #f95858;
}

.contacts li .contacts-add .fa-paperclip:hover {
  color: #ff9e2a;
}

.contacts li > .info-combo > h5 {
  width: 180px;
  font-size: 12px;
  height: 28px;
  font-weight: 500;
  overflow: hidden;
  white-space: normal;
  text-overflow: ellipsis;
}

.contacts li .message-count {
  position: absolute;
  top: 8px;
  left: 5px;
  width: 20px;
  height: 20px;
  line-height: 20px;
  text-align: center;
  background-color: #ff9e2a;
  border-radius: 50%;
  color: #fff;
  font-weight: 600;
  font-size: 10px;
}

.message-body {
  background-color: #fbfcff;
  height: 100%;
  position: relative;
  width:100%; 
}
 
.message-text:hover .Actions{
    display: block;
}
.message-body .message-top {
  display: inline-block;
  width: 100%;
  position: relative;
  min-height: 53px;
  height: auto;
  background-color: #fff; 
}

.message-body .message-top .new-message-wrapper {
  width: 100%;
}

.message-body .message-top .new-message-wrapper > .form-group {
  width: 100%;
  padding: 10px 10px 0 10px;
  height: 50px;
}

.message-body .message-top .new-message-wrapper .form-group .form-control {
  width: calc(100% - 50px);
  float: left;
}

.message-body .message-top .new-message-wrapper .form-group a {
  width: 40px;
  padding: 6px 6px 6px 6px;
  text-align: center;
  display: block;
  float: right;
  margin: 0;
}

.message-body .message-top > .btn {
  height: 53px;
  line-height: 53px;
  padding: 0 20px;
  float: right;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  border-bottom-right-radius: 0;
  margin: 0;
  font-size: 15px;
  opacity: 0.9;
}

.message-body .message-top > .btn:hover,
.message-body .message-top > .btn:focus,
.message-body .message-top > .btn.active {
  opacity: 1;
}

.message-body .message-top > .btn > i {
  margin-right: 5px;
  font-size: 18px;
}

.new-message-wrapper {
  position: absolute;
  max-height: 400px;
  top: 53px;
  background-color: #fff;
  z-index: 105;
  padding: 20px 15px 30px 15px; 
  border-bottom-left-radius: 3px;
  border-bottom-right-radius: 3px;
  box-shadow: 0 7px 10px rgba(0,0,0,0.25);
  transition: 0.5s;
  display: none;
}

.new-message-wrapper.closed {
  opacity: 0;
  max-height: 0;
}

.chat-footer.new-message-textarea {
  display: block;
  position: relative;
  padding: 0 10px;
}
.chat-footer{
    display: block;
    position: relative;
}
.chat-footer.new-message-textarea .send-message-button {
  right: 35px;
}

.chat-footer.new-message-textarea .upload-file {
  right: 85px;
}

.chat-footer.new-message-textarea .send-message-text {
  padding-right: 100px;
  height: 90px;
}

.message-chat {
  width: 100%;
  overflow: hidden;
}

.chat-body {
  width: calc(100% + 17px);
  min-height: 290px;
  height: calc(100vh - 320px);
  background-color: #fbfcff;
  margin-bottom: 30px;
  padding: 30px 5px 5px 5px;
  overflow-y: scroll;
}

.message {
  position: relative;
  width: 100%;
}

.message br {
  clear: both;
}

.message .message-body {
  position: relative;
  width: auto;
  max-width: calc(100% - 150px);
  float: left;
  background-color: #fff;
  border-radius: 4px;
  border: 1px solid #1260CC;
  margin: 0 5px 20px 15px;
  color: #788288;
}

.message:after {
  content: "";
  position: absolute;
  top: 11px;
  left: 63px;
  float: left;
  z-index: 100;
  border-top: 10px solid transparent;
  border-left: none;
  border-bottom: 10px solid transparent;
  border-right: 13px solid #fff;
}

.message:before {
  content: "";
  position: absolute;
  top: 10px;
  left: 62px;
  float: left;
  z-index: 99;
  border-top: 11px solid transparent;
  border-left: none;
  border-bottom: 11px solid transparent;
  border-right: 13px solid #1260CC;
}

.message .medium-image {
  float: left;
  margin-left: 10px;
}

.message .message-info {
  width: 100%;
  height: 22px;
}

.message .message-info > h5 > i {
  font-size: 11px;
  font-weight: 700;
  margin: 0 2px 0 0;
  color: #1260CC;
}

.message .message-info > h5 {
  color: #1260CC;
  margin: 8px 0 0 0;
  font-size: 12px;
  float: right;
  padding-right: 10px;
}

.message .message-info > h4 {
  font-size: 14px;
  font-weight: 600;
  margin: 7px 13px 0 10px;
  color:#1260CC;
  float: left;
}

.message hr {
  margin: 4px 2%;
  width: 96%;
  opacity: 0.08;
}

.message .message-text {
  text-align: left;
  padding: 3px 13px 4px 13px;
  font-size: 14px;
}

.message.my-message .message-body {
  float: right;
  margin: 0 15px 20px 5px;
}

.message.my-message:after {
  content: "";
  position: absolute;
  top: 11px;
  left: auto;
  right: 63px;
  float: left;
  z-index: 100;
  border-top: 10px solid transparent;
  border-left: 13px solid #fff;
  border-bottom: 10px solid transparent;
  border-right: none;
}

.message.my-message:before {
  content: "";
  position: absolute;
  top: 10px;
  left: auto;
  right: 62px;
  float: left;
  z-index: 99;
  border-top: 11px solid transparent;
  border-left: 13px solid #1260CC;
  border-bottom: 11px solid transparent;
  border-right: none;
}

.message.my-message .medium-image {
  float: right;
  margin-left: 5px;
  margin-right: 10px;
}

.message.my-message .message-info > h5 {
  float: left;
  padding-left: 10px;
  padding-right: 0;
}

.message.my-message .message-info > h4 {
  float: right;
}

.message.info .message-body {
  background-color: #1260CC;
  border: 1px solid #1260CC;
  color: #fff;
}

.message.info:after, .message.info:before {
  border-right: 13px solid #1260CC;
}

.message.success .message-body {
  background-color: #0ec8a2;
  border: 1px solid #0ec8a2;
  color: #fff;
}

.message.success:after, .message.success:before {
  border-right: 13px solid #0ec8a2;
}

.message.warning .message-body {
  background-color: #ff9e2a;
  border: 1px solid #ff9e2a;
  color: #fff;
}

.message.warning:after, .message.warning:before {
  border-right: 13px solid #ff9e2a;
}

.message.danger .message-body {
  background-color: #f95858;
  border: 1px solid #f95858;
  color: #fff;
}

.message.danger:after, .message.danger:before {
  border-right: 13px solid #f95858;
}

.message.dark .message-body {
  background-color: #314557;
  border: 1px solid #314557;
  color: #fff;
}

.message.dark:after, .message.dark:before {
  border-right: 13px solid #314557;
}

.message.info .message-info > h4, .message.success .message-info > h4,
.message.warning .message-info > h4, .message.danger .message-info > h4,
.message.dark .message-info > h4 {
  color: #fff;
}

.message.info .message-info > h5, .message.info .message-info > h5 > i,
.message.success .message-info > h5, .message.success .message-info > h5 > i,
.message.warning .message-info > h5, .message.warning .message-info > h5 > i,
.message.danger .message-info > h5, .message.danger .message-info > h5 > i,
.message.dark .message-info > h5, .message.dark .message-info > h5 > i {
  color: #fff;
  opacity: 0.9;
}

.chat-footer {
  position: relative;
  width: 100%;
  padding: 0 80px;
}

.chat-footer .send-message-text {
  position: relative;
  display: block;
  width: 100%;
  min-height: 55px;
  max-height: 75px;
  background-color: #fff;
  border-radius: 5px;
  padding: 5px 95px 5px 10px;
  font-size: 13px;
  resize: vertical;
  outline: none;
  border: 1px solid #e0e6eb;
}

.chat-footer .send-message-button {
  display: block;
  position: absolute;
  width: 35px;
  height: 35px;
  right: 100px;
  top: 0;
  bottom: 0;
  margin: auto;
  border: 1px solid rgba(0,0,0,0.05);
  outline: none;
  font-weight: 600;
  border-radius: 50%;
  padding: 0;
}

.chat-footer .send-message-button > i {
  font-size: 16px;
  margin: 0 0 0 -2px;
}

.chat-footer label.upload-file input[type="file"] {
  position: fixed;
  top: -1000px;
} 
.chat-footer .upload-file {
  display: block;
  position: absolute;
  right: 100px;
  background: #e0e6eb;
  cursor: pointer;
  height: 30px;
  width: 40px;
  text: center;
  align-items: center;
  justify-content: center;
  padding: 5px;
  padding-top: 0;
  padding-bottom:5px;
  font-size: 25px;
  top: 0;
  bottom: 0;
  border-radius: 5px;
  margin: auto;
  opacity: 0.50;
}

.chat-footer .upload-file:hover {
  opacity: 1;
}

@media screen and (max-width: 767px) {
  .messages-panel {
    min-width: 0;
    display: inline-block;
  }

  .contacts-list, .contacts-list .inbox-categories > div:nth-child(4) {
    border-top-right-radius: 5px;
    border-right: none;
  }

  .contacts-list, .contacts-outter-wrapper, .contacts-outter, .contacts {
    width: 100%;
    direction: ltr;
    padding-left: 0;
  }

  .contacts-list .inbox-categories > div {
    width: 25%;
  }

  .message-body {
    width: 100%;
    margin: 20px 0;
    border: 1px solid #dce2e9;
    background-color: #fff;
  }

  .message .message-body {
    max-width: calc(100% - 85px);
  }

  .message-body .chat-body {
    background-color: #fff;
    width: 100%;
  }

  .chat-footer {
    margin-bottom: 20px;
    padding: 0 20px;
  }

  .chat-footer .send-message-button {
    right: 40px;
  }

  .chat-footer .upload-file {
    right: 90px;
  }

  .message-body .message-top > .btn {
    border-radius: 0;
    width: 100%;
  }

  .contacts-add {
    display: none;
  }
}

/* Profile page */

.profile-main {
  background-color: #fff;
  border: 1px solid #dce2e9;
  border-radius: 3px;
  position: relative;
  margin-bottom: 20px;
}

.profile-main .profile-background {
  background-image: url('../images/samples/forest.png');
  background-repeat: no-repeat;
  background-size: 100%;
  background-position: center;
  width: 100%;
  height: 260px;
}

.profile-main .profile-info {
  width: calc(100% - 380px);
  max-width: 1100px;
  margin: 0 auto;
  background-color: #fff;
  height: 70px;
  border-radius: 0 0 3px 3px;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.profile-main .profile-info > div {
  margin: 0 10px;
}

.profile-main .profile-info > div:last-child {
  padding-right: 25px;
}

.profile-main .profile-info > div h4 {
  font-size: 16px;
  margin-bottom: 0;
}

.profile-main .profile-info > div h5 {
  margin-top: 5px;
  font-weight: 500;
}

.profile-main .profile-button {
  padding: 8px 0;
  position: absolute;
  right: 25px;
  bottom: 16px;
  width: 150px;
}

.profile-main .profile-picture {
  width: 150px;
  height: 150px;
  border: 4px solid #fff;
  position: absolute;
  left: 25px;
  bottom: 14px;
}

@media screen and (max-width: 767px) {
  .profile-main .profile-info .profile-status,
  .profile-main .profile-info .profile-posts,
  .profile-main .profile-info .profile-date {
    display: none;
  }
}

.contacts li > .info-combo {
   display:inline-block;
}


.row:after, .row:before {
  content: " ";
  display: table;
  clear: both;
}
.span6 {
  float: left;
  width: 48%;
  padding: 1%;
}

.emojionearea-standalone {
  float: right;
}

    </style>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('emojis/dist/emojionearea.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.css" integrity="sha512-0Nyh7Nf4sn+T48aTb6VFkhJe0FzzcOlqqZMahy/rhZ8Ii5Q9ZXG/1CbunUuEbfgxqsQfWXjnErKZosDSHVKQhQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style type="text/css">
        .demo-gallery{
            width: 300px;
    } 
    </style>
    @endpush

    @push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/emojionearea/3.4.2/emojionearea.min.js" integrity="sha512-hkvXFLlESjeYENO4CNi69z3A1puvONQV5Uh+G4TUDayZxSLyic5Kba9hhuiNLbHqdnKNMk2PxXKm0v7KDnWkYA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script type="text/javascript" src="{{ asset('emojis/dist/emojionearea.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#emojionearea1").emojioneArea({
   pickerPosition: "top",
    filtersPosition: "bottom",
    tones: false,
    autocomplete: false,
    inline: true,
    hidePickerOnBlur: false
  });

});
</script>
<script>
    $(document).ready(function(){
        $('#lightgallery').lightGallery(); 
    });
</script>
<script type="text/javascript" src="{{ asset('js/imageShow.js') }}"></script>
@endpush 
