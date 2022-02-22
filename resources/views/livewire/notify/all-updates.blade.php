<div class="container" wire:poll>
    <div class="row">
        <div class="col-lg-12 mt-2">
            <div class="container-fluid">
                <div class="row justify-content-center"> 
                    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Notifications</a>
                        </li>
                    </ul>
                    <div class="col-lg-8">
                        <div  class="my-4">
                            <div class="list-group mb-5">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col"> 
                                            <strong class="mb-0">{{auth()->user()->u_fullname}}</strong>Thank you for joing {{config('app.name')}} family
                                            </p>
                                        </div> 
                                    </div>
                                </div> 
                            </div>
                        </div>
                    </div>
                    @if(!empty($family)) 
                    <div class="col-lg-8"> 
                        <div class="my-4"> 
                            @if($checkUserDetails) 
                            <strong class="mb-0">Requests to join family</strong> <br>
                            @forelse($checkUserDetails as $user)
                                <div class="list-group mb-5">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col"> 
                                                <strong class="mb-0">{{$user->u_fullname}}</strong> asked to join family as {{$user->relation}} of this person
                                                <p class="text-muted mb-0 text-break">
                                                    {{$user->to}} 
                                                    {{ $user->info}}
                                                </p>
                                            </div>
                                            <div class="col-auto"> 
                                                <div class="d-flex flex-row">
                                                    <form method="POST" wire:submit.prevent="Approve('{{$user->u_id}}')">
                                                        <button class="btn btn-sm btn-default" name="Approve">Approve</button>
                                                    </form>
                                                    <form method="POST" wire:submit.prevent="delete('{{$user->id}}')">
                                                        <button class="btn btn-sm btn-danger ml-2" name="delete">Delete</button>
                                                    </form> 
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div> 
                            @empty
                            <small class="text-muted">No requests</small>
                            @endforelse
                            @else
                                 <small class="text-muted">unable to retrieve data</small>
                            @endif
                        </div>
                    </div> 
                    @endif 
                    <div class="col-lg-8"> 
                          @if(!empty($Request_User_Join_Family))
                            <div class="my-4">   
                                <strong class="mb-0">Requests to be added in family</strong> <br>
                                @if($Request_User_Join_Family)
                                    @if($UserDetails)
                                        @forelse($UserDetails as $user)
                                        @php 
                                            $toRelative=\App\Models\User::where('u_id',$Request_User_Join_Family->user_requested)->get()->first();
                                        @endphp 
                                            <div class="list-group mb-5">
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col"> 
                                                            <p class="text-muted mb-0 text-break"> You've been asked to join family as {{$user->relation}} of {{$toRelative->u_fullname}} 
                                                            </p>
                                                        </div>
                                                        <div class="col-auto"> 
                                                            <div class="d-flex flex-row">
                                                                <form method="POST" wire:submit.prevent="Accept('{{$user->u_id}}')">
                                                                    <button class="btn btn-sm btn-default" name="Approve">Accept</button>
                                                                </form>
                                                                <form method="POST" wire:submit.prevent="deleteRequest('{{$user->id}}')">
                                                                    <button class="btn btn-sm btn-danger ml-2" name="delete">Delete</button>
                                                                </form> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>

                                        @empty
                                        <small class="text-muted">No requests</small>
                                        @endforelse
                                    @endif
                                @endif
                            </div>
                            @endif 
                    </div> 
                    <div class="col-lg-8">
                        @if(!empty($notifications)) 
                            <strong class="">Other Notifications</strong>
                            <div class="my-2">   
                                @forelse($notifications as $notification)
                                    @php
                                    $user=\App\Models\User::where('u_id',$notification->data['data']['user'])->get()->first();
                                    $userFm=\App\Models\Family::where('f_id',auth()->user()->u_id)->get()->first();
                                    @endphp
                                    @if($notification->data['data']['type']=='message') 
                                        @if($notification->data['data']['to']==auth()->user()->u_id)
                                            <div wire:click.prevent="markAsReadGoto('{{$notification->id}}')" class="list-group mb-2 border-0 shadow-sm">
                                                <div class="list-group-item">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto friend-img p-1">
                                                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                                @if(!empty($user->profile_photo_path)) 
                                                                    <img alt="{{ $user->u_fullname }}"  class="  medium-image border-0 bg-none" src="{{asset('storage/'.$user->profile_photo_path)}}" width="50px" />
                                                                @else
                                                                    <img alt="" class=" medium-image border-0 bg-none" src="{{asset('/assets/img/account.jpg')}}" width="50px"/>
                                                                @endif
                                                            @else 
                                                                <img alt="" class=" medium-image border-0 bg-none" src="{{asset('/assets/img/account.jpg')}}" width="50px"/>
                                                            @endif
                                                        </div>
                                                        <div class="col"> 
                                                            <p class="text-muted mb-0 text-break"> 
                                                          {{--       {{ $notification->data['data']['typeuserto'] }} --}}
                                                                New message notication from {{$user->u_fullname}}  
                                                            </p>
                                                        </div>
                                                        <div class="col-auto"> 
                                                            <div class="d-flex flex-row"> 
                                                                <form method="POST" wire:submit.prevent="markAsRead('{{$notification->id}}')">
                                                                    <button class="btn btn-sm text-danger ml-2 font-weight-bold" name="delete">Mark as read</button>
                                                                </form> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        @endif
                                        @elseif($notification->data['data']['type']=='stories')
                                            @if($notification->data['data']['user']!=auth()->user()->u_id)
                                                @if(!empty($userFm))
                                                @if($notification->data['data']['family_id']==$userFm->f_indentity)
                                                <a href="{{route('status.show',$notification->data['data']['user'])}}" class="list-group mb-2 border-0 shadow-sm">
                                                    <div class="list-group-item">
                                                        <div class="row align-items-center">
                                                            <div class="col-auto friend-img p-1">
                                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                                    @if(!empty($user->profile_photo_path)) 
                                                                        <img alt="{{ $user->u_fullname }}"  class="  medium-image border-0 bg-none" src="{{asset('storage/'.$user->profile_photo_path)}}" width="50px" />
                                                                    @else
                                                                        <img alt="" class=" medium-image border-0 bg-none" src="{{asset('/assets/img/account.jpg')}}" width="50px"/>
                                                                    @endif
                                                                @else 
                                                                    <img alt="" class=" medium-image border-0 bg-none" src="{{asset('/assets/img/account.jpg')}}" width="50px"/>
                                                                @endif
                                                            </div>
                                                            <div class="col">  
                                                                <p class="text-muted mb-0 text-break"> 
                                                              {{--       {{ $notification->data['data']['typeuserto'] }} --}}
                                                                    New story added by  {{$user->u_fullname}}  
                                                                </p>
                                                            </div>
                                                            <div class="col-auto"> 
                                                                <div class="d-flex flex-row"> 
                                                                    <form method="POST" wire:submit.prevent="markAsRead('{{$notification->id}}')">
                                                                        <button class="btn btn-sm text-danger ml-2 font-weight-bold" name="delete">Mark as read</button>
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </a>
                                            @endif
                                            @endif
                                        @endif
                                    @endif
                                @empty
                                Nothing to show
                                @endforelse 
                            </div> 
                           
                        @endif
                    </div>
                </div> 
            </div>
         </div> 
    </div>
</div>

@push('style')
    <style type="text/css">
        .friend-img img{
            width: 40px;    
            border-radius:15%;
            heigth: 60px;
        }
        .list-group{
            cursor: :pointer;
        }
        .list-group p{
            cursor: pointer;
        }
    </style>
@endpush