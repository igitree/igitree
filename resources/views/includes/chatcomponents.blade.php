
     <a href="{{ route('chat.user', $users->u_id) }}" class="mt-1">
        <li class="borderlist {{-- active --}}" > 
            <div class="d-flex flex-row text-truncate">
                <div class="" style="width: 50px;height: 50px"> 
                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        @if(!empty($users->profile_photo_path)) 
                            <img alt="{{ $users->u_fullname }}"  alt="{{ $users->u_fullname }}"  class="img-circle medium-image" src="{{asset('storage/'.$users->profile_photo_path)}}" width="100%"/>
                        @else
                            <img alt="" class="img-circle medium-image" alt="{{ $users->u_fullname }}"  src="{{asset('/assets/img/account.jpg')}}"width="100%"/>
                        @endif
                    @else 
                        <img alt="" class="img-circle medium-image" alt="{{ $users->u_fullname }}"  src="{{asset('/assets/img/account.jpg')}}"width="100%"/>
                    @endif 
                </div>
                <div class="text-truncate">
                    <h3 class="no-margin-bottom name text-truncate"> {{ $users->u_fullname }} </h3> 
                        <p class=" text-truncate text-break {{ $chat->c_sender == auth()->user()->u_id ? 'text-muted':'text-dark'}}">
                            @if($chat->c_sender == auth()->user()->u_id) You: 
                            @endif
                            @if($chat->c_message=='null' or !empty($chat->c_image)) 
                            Image
                            @else
                            {{$chat->c_message }}
                            @endif
                        </p>  
                </div>
            </div> 

            <div class="contacts-add"> 
                 <i class="fa fa-trash-o"><small>{{  \Carbon\Carbon::parse($chat->c_date)->format('d D')}}</ssmall></i>      
             </div>

        </li>
    </a> 