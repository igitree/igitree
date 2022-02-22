@if($user)
@if(!empty($user))
    <div class="container">
        <div id="content" class="content p-0">
            <div class="profile-header">
                <div class="profile-header-cover"></div>
                <div class="profile-header-content">
                    <div class="profile-header-img mb-2">
                       @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            @if(!empty($user->profile_photo_path)) 
                             <img alt="" class=" medium-image border-0 bg-none" src="{{asset('storage/'.$user->profile_photo_path)}}">
                            @else
                                <img alt="" class=" medium-image border-0 bg-none" src="{{asset('/assets/img/account.jpg')}}">
                            @endif
                        @else
                            <img alt="" class=" medium-image border-0 bg-none" src="{{asset('/assets/img/account.jpg')}}">
                        @endif 
                    </div> 
                    <div class="profile-header-info m-3">
                        <h4 class="m-t-sm">{{ $user->u_fullname }}</h4>
                        <p class="m-b-sm">{{ $user->u_email }}</p>
                        @if(auth()->user()->u_id == $user->u_id)
                            <a href="{{ route('profile.show') }}" class="btn btn-sm btn-default mb-2">Edit Profile</a>
                            <a href="{{ route('tree') }}" class="btn btn-sm btn-default mb-2">View tree</a>
                        @elseif(auth()->user()->u_id != $user->u_id)
                            <a href="{{ route('chat.user',$user->u_id) }}" class="float-right btn btn-sm btn-default mb-2">Message</a>
                        @endif
                    </div>
                </div>   
            </div>
            <ul class="profile-header-tab nav nav-tabs bg-white shadow-sm">
                <li class="nav-item"><a href="#profile-family" class="nav-link" >Family members @if($Family){{$Family->count()}}@endif</a></li> 
                <li class="nav-item"><a href="#profile-album" class="nav-link  show">Family Albums @if($Albums){{$Albums->count()}}@endif</a></li>
            </ul>  
                <div class="tab-content" id="nav-tabContent">
                    <div class="profile-container">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class="row row-space-20">
                                <div class="col-md-8">
                                    <div class="row">
                                         <div class="col-lg-12" id="profile-family">
                                            <div class="tab-content p-0"> 
                                                <div class="tab-pane fade active show" id="profile-friends">
                                                    <div class="m-b-10 text-default mb-2"><b>Family members List</b></div>

                                                    <ul class="friend-list clearfix">
                                                        @if($Family)
                                                            @forelse($Family as $userInfo)
                                                                @if($userInfo->u_id!=$user->u_id)
                                                                    <li>
                                                                        <a href="{{ route('singleprofile',$userInfo->u_id) }}">
                                                                            <div class="friend-img">
                                                                                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                                                                    @if(!empty($userInfo->profile_photo_path)) 
                                                                                     <img alt="{{ $userInfo->u_fullname }}" class="shadow medium-image" src="{{asset('storage/'.$userInfo->profile_photo_path)}}" width="300" style="width:300px">
                                                                                    @else
                                                                                        <img alt="{{ $userInfo->u_fullname }}" class="shadow medium-image" src="{{asset('/assets/img/account.jpg')}}">
                                                                                    @endif
                                                                                @else
                                                                                    <img alt="{{ $userInfo->u_fullname }}" class="shadow medium-image" src="{{asset('/assets/img/account.jpg')}}">
                                                                                @endif
                                                                            </div>
                                                                            <div class="friend-info">
                                                                                <h4>{{ $userInfo->u_fullname }}</h4>
                                                                                <p><small>  
                                                                                    @if($userInfo->f_mothers==$user->u_id or $userInfo->f_fathers==$user->u_id)
                                                                                        @if($userInfo->u_gender=='Male')
                                                                                            Son
                                                                                        @else
                                                                                            Daughter
                                                                                        @endif
                                                                                    @elseif($userInfo->f_wives==$user->u_id)
                                                                                        Wife
                                                                                    @elseif($userInfo->f_husbands==$user->u_id)
                                                                                        Husband
                                                                                    @elseif($userInfo->f_id==$user->f_mothers)
                                                                                        Mother
                                                                                    @elseif($userInfo->f_id==$user->f_fathers)
                                                                                        Father
                                                                                    @elseif($userInfo->f_mothers!=$user->u_id and $userInfo->f_fathers!=$user->u_id and $userInfo->f_wives!=$user->u_id and $userInfo->f_husbands!=$user->u_id)
                                                                                        Family member
                                                                                    @endif 
                                                                                     
                                                                               </small> </p>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @empty
                                                            No family members 
                                                            @endforelse
                                                        @else
                                                        No family members
                                                        @endif 
                                                    </ul>
                                                </div>
                                            </div> 
                                         </div>
                                        <div class="col-lg-12 mt-3" id="profile-album">
                                            <div class="m-b-10 text-default mb-2"><b>Albums</b></div> 
                                            <div class="card rounded-0"> 
                                                @if(!empty($Albums))
                                                    <div class="card-body row" > 
                                                     @forelse($Albums as $Album) 
                                                    <div class="col-lg-4 mb-2">
                                                        <a href="{{ route('albums.show',$Album->id) }}" >
                                                        @if($Album->photos->count() !=0) 
                                                            <div class="card border-0 card-image p-0" style="background-image: url('{{asset('storage/photos/'.$Album->photos[0]->i_image)}}');height:250px;position:relative;">
                                                            @else
                                                         <div class="card border-0 card-image p-0" style="background-image: url('https://via.placeholder.com/150');height:250px;position:relative;"> 
                                                        @endif
                                                              <!-- Content -->
                                                              <div class="text-white mt-5 text-center d-flex align-items-center coverbannerbottom  " style="background-image: linear-gradient(to bottom, rgba(18,96,204,0), rgba(18,96,204,.8));position:absolute;bottom:0;width:100%">
                                                                  <div class="row pt-5 mt-5 justify-content-center" style="width: 100%">
                                                                    <div class="col-lg-8"> 
                                                                      <small class="">{{ $Album->created_at->format('Y-M') }} <br>
                                                                    {{ $Album->photos->count() }} images added</small>
                                                                    </div> 
                                                                  </div>
                                                              </div>
                                                              <!-- Content -->
                                                          </div>
                                                      </a>
                                                    </div> 
                                                     @empty
                                                     <div class="justify-content-center" >
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
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-md-4 hidden-xs hidden-sm mt-3">
                                    <ul class="profile-info-list">
                                        <li class="title">PERSONAL INFORMATION</li>
                                        @if($user->u_dob)
                                            <li>
                                                <div class="field">Birth of Date:</div>
                                                <div class="value">{{$user->u_dob}}</div>
                                            </li>
                                        @elseif($user->u_country)
                                            <li>
                                                <div class="field">Country:</div>
                                                <div class="value">{{$user->u_country}}</div>
                                            </li>
                                        @elseif($user->u_address)
                                            <li>
                                                <div class="field">Address:</div>
                                                <div class="value">
                                                    <address class="m-b-0">
                                                        {{$user->u_address}}
                                                    </address>
                                                </div>
                                            </li>
                                        @elseif($user->u_phoneline)
                                            <li>
                                                <div class="field">Phone No.:</div>
                                                <div class="value">
                                                    {{$user->u_phoneline}}
                                                </div>
                                            </li>
                                        @else
                                        @if(auth()->user()->u_id ==$user->u_id)
                                         <a href="{{ route('profile.show') }}" class="mt-3 btn btn-default btn-sm">Complete profile </a>
                                        @else
                                            <span class="text-muted">No personal info</span>
                                         @endif  
                                        @endif
                                    </ul>
                                </div>
                            </div> 
                        </div>  
                    </div>
                </div>
        </div>
    </div>
@else
No user info
@endif
@else
No user info
@endif

@push('style')

    <style type="text/css">
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
.profile-info-list {
    padding: 0;
    margin: 0;
    list-style-type: none;
}
.friend-list,
.img-grid-list {
    margin: -1px;
    list-style-type: none;
}
.profile-info-list > li.title {
    font-size: 0.625rem;
    font-weight: 700;
    color: #8a8a8f;
    padding: 0 0 0.3125rem;
}
.profile-info-list > li + li.title {
    padding-top: 1.5625rem;
}
.profile-info-list > li {
    padding: 0.625rem 0;
}
.profile-info-list > li .field {
    font-weight: 700;
}
.profile-info-list > li .value {
    color: #666;
}
.profile-info-list > li.img-list a {
    display: inline-block;
}
.profile-info-list > li.img-list a img {
    max-width: 2.25rem;
    -webkit-border-radius: 2.5rem;
    -moz-border-radius: 2.5rem;
    border-radius: 2.5rem;
}
.coming-soon-cover img,
.email-detail-attachment .email-attachment .document-file img,
.email-sender-img img,
.friend-list .friend-img img,
.profile-header-img img {
    width: 100%;
    border-radius:50%;
    heigth: 100%;
}
.table.table-profile th {
    border: none;
    color: #000;
    padding-bottom: 0.3125rem;
    padding-top: 0;
}
.table.table-profile td {
    border-color: #c8c7cc;
}
.table.table-profile tbody + thead > tr > th {
    padding-top: 1.5625rem;
}
.table.table-profile .field {
    color: #666;
    font-weight: 600;
    width: 25%;
    text-align: right;
}
.table.table-profile .value {
    font-weight: 500;
}
.profile-header {
    position: relative;
    overflow: hidden;
}
.profile-header .profile-header-cover {
    background: url({{asset("assets/images/UITREE.jpg")}}) center no-repeat;
    background-size: 100% auto;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
}
.profile-header .profile-header-cover:before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    background: rgba(0, 0,0,0.5);
    right: 0;
    bottom: 0;
}

.album-footer{
background: linear-gradient(to bottom, rgba(0, 0, 0, 0.27) 0, rgba(0, 0, 0, 0.90) 100%);
}
.profile-header .profile-header-content,
.profile-header .profile-header-tab,
.profile-header-img,
body .fc-icon {
    position: relative;
}
.profile-header .profile-header-tab {
    background: #fff;
    list-style-type: none;
    margin: -1.25rem 0 0;
    padding: 0 0 0 8.75rem;
    border-bottom: 1px solid #c8c7cc;
    white-space: nowrap;
}
.profile-header .profile-header-tab > li {
    display: inline-block;
    margin: 0;
}
.profile-header .profile-header-tab > li > a {
    display: block;
    color: #000;
    line-height: 1.25rem;
    padding: 0.625rem 1.25rem;
    text-decoration: none;
    font-weight: 700;
    font-size: 0.75rem;
    border: none;
}
.profile-header .profile-header-tab > li.active > a,
.profile-header .profile-header-tab > li > a.active {
    color: #007aff;
}
.profile-header .profile-header-content:after,
.profile-header .profile-header-content:before {
    content: "";
    display: table;
    clear: both;
}
.profile-header .profile-header-content {
    color: #fff;
    padding: 1.25rem;
}
body .fc th a,
body .fc-ltr .fc-basic-view .fc-day-top .fc-day-number,
body .fc-widget-header a {
    color: #000;
}
.profile-header-img {
    float: left;
    width: 7.5rem;
    height: 7.5rem;
    overflow: hidden;
    z-index: 10;
    margin: 0 1.25rem -1.25rem 1rem; 
    background: #fff; 
    border-radius:50%; 
}
.profile-header-info h4 {
    font-weight: 500;
    margin-bottom: 0.3125rem;
}
.profile-container {
    padding: 1.5625rem;
}
@media (max-width: 967px) {
    .profile-header-img {
        width: 5.625rem;
        height: 5.625rem;
        margin: 0;
    }
    .profile-header-info {
        margin-left: 6.5625rem;
        padding-bottom: 0.9375rem;
    }
    .profile-header .profile-header-tab {
        padding-left: 0;
    }
}
@media (max-width: 767px) {
    .profile-header .profile-header-cover {
        background-position: top;
    }
    .profile-header-img {
        width: 3.75rem;
        height: 3.75rem;
        margin: 0;
    }
    .profile-header-info {
        margin-left: 4.6875rem;
        padding-bottom: 0.9375rem;
    }
    .profile-header-info h4 {
        margin: 0 0 0.3125rem;
    }
    .profile-header .profile-header-tab {
        white-space: nowrap;
        overflow: scroll;
        padding: 0;
    }
    .profile-container {
        padding: 0.9375rem 0.9375rem 3.6875rem;
    }
    .friend-list > li {
        float: none;
        width: auto;
    }
}
.profile-info-list {
    padding: 0;
    margin: 0;
    list-style-type: none;
}
.friend-list,
.img-grid-list {
    margin: -1px;
    list-style-type: none;
}
.profile-info-list > li.title {
    font-size: 0.625rem;
    font-weight: 700;
    color: #8a8a8f;
    padding: 0 0 0.3125rem;
}
.profile-info-list > li + li.title {
    padding-top: 1.5625rem;
}
.profile-info-list > li {
    padding: 0.625rem 0;
}
.profile-info-list > li .field {
    font-weight: 700;
}
.profile-info-list > li .value {
    color: #666;
}
.profile-info-list > li.img-list a {
    display: inline-block;
}
.profile-info-list > li.img-list a img {
    max-width: 2.25rem;
    -webkit-border-radius: 2.5rem;
    -moz-border-radius: 2.5rem;
    border-radius: 2.5rem;
}
.coming-soon-cover img,
.email-detail-attachment .email-attachment .document-file img,
.email-sender-img img,
.friend-list .friend-img img,
.profile-header-img img {
    max-width: 100%;
    height:100%;
}
.table.table-profile th {
    border: none;
    color: #000;
    padding-bottom: 0.3125rem;
    padding-top: 0;
}
.table.table-profile td {
    border-color: #c8c7cc;
}
.table.table-profile tbody + thead > tr > th {
    padding-top: 1.5625rem;
}
.table.table-profile .field {
    color: #666;
    font-weight: 600;
    width: 25%;
    text-align: right;
}
.table.table-profile .value {
    font-weight: 500;
}

.friend-list {
    padding: 0;
}
.friend-list > li {
    float: left;
    width: 50%;
}
.friend-list > li > a {
    display: block;
    text-decoration: none;
    color: #000;
    padding: 0.625rem;
    margin: 1px;
    background: #fff;
}
.friend-list > li > a:after,
.friend-list > li > a:before {
    content: "";
    display: table;
    clear: both;
}
.friend-list .friend-img {
    float: left;
    width: 3rem;
    height: 3rem;
    border-radius: 50%;
    overflow: hidden;
    background: #efeff4;
}
.friend-list .friend-info {
    margin-left: 3.625rem;
}
.friend-list .friend-info h4 {
    margin: 0.3125rem 0;
    font-size: 0.875rem;
    font-weight: 600;
}
.friend-list .friend-info p {
    color: #666;
    margin: 0;
}


/* Hover Effects on Card */

@media (min-width: 992px) {
  .friend-list li:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
    box-shadow: 0 0.5rem .6rem 0 rgba(0, 0, 0, 0.3);
  }

}

    </style>
@endpush