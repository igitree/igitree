<div class="container ">
    <div class="panel messages-panel mt-3 shadow-sm">
        <div class="contacts-list"> 
           <div class="inbox-categories sticky-top">
                <div data-toggle="tab" data-target="#inbox" class="active"> Inbox </div>  
            </div>
            <div class="tab-content">
                {{-- <form class="panel-search-form info form-group sticky-top has-feedback no-margin-bottom">
                    <input type="search" class="mt-2 form-control rounded-0 border-0" name="search" placeholder="Search...." wire:keydown="searching" wire:model="searchTerm"> 
                </form> --}}
                <div class="panel-tabs p-2 text-muted no-margin-bottom text-break">
                  @if($searchTerm)<strong>Searching for:</strong> {{ $searchTerm}} @endif
                </div>
                <div id="inbox" class="contacts-outter-wrapper tab-pane active">
                    <div class="contacts-outter">
                        <ul class="list-unstyled contacts">
                           <div class="p-2" wire:loading wire:target="searchTerm">
                            @include('includes.simpleLoading')
                          </div>
                            @if(empty($searchTerm))  
                            @forelse ($recentChatFUser as $userchats => $recentMessageList) 
                                  <small> 
                                  @php
                                      $users=DB::table('tbl_users')->where('u_id',$userchats)
                                                                  ->get()->first();
                                      $chat=DB::table('tbl_chats')->where('c_sender',$userchats)
                                                                    ->orWhere('c_recipient',$userchats)
                                                                    ->orderBy('c_date','desc')
                                                                    ->get()->first();

                                  @endphp
                                    @if($users->u_id != auth()->user()->u_id)
                                      @include('includes.chatcomponents')
                                    @endif
                                  </small> 
                              @empty
                                  <x-nouser/>
                            @endforelse 
                            
                            @endif 
                        </ul>
                    </div>
                </div> 
            </div>
        </div> 
        <div class="tab-content">
            <div class="tab-pane message-body active text-muted" id="inbox-message-1" style="position:relative;"> 
              <div class="row p-3">
                <div class="col-lg-12">
                    <h6>New message</h6>
                </div>
                <div class="col">
                  <div class="row">
                    <div class="col-lg-12">
                      <input type="text" wire:model="NewName" class="form-control" wire:keyup="NewMessage" placeholder="Type in fullname..">
                    </div> 
                    @if(!empty($searchResults) and $closesearch!=1 and !empty($NewName))
                      <div class="col-lg-11 " style="position: relative;"> 
                        <div class="row  ml-3 mr-3 p-2 bg-white shadow-sm" style="position:absolute;width: 100%">
                          <div class="col-lg-12 text-right" style="cursor: pointer;">
                            <span class="bg-danger p-1 text-white rounded" wire:click="closeSearching">close</span>
                          </div>
                        @forelse($searchResults as $result)
                            @if(!empty($result) or $result!='' or $result!=null)
                            <a href="" class="col-lg-10 p-3">@if(!empty($result->u_fullname)){{$result->u_fullname}}, {{$result->u_email}}@endif @if(!empty($result->u_country))currentry live in {{$result->u_country}}@endif
                            </a>                           
                            @endif 
                          @empty
                          <p class="text-center">No results found </p>
                        @endforelse
                        <div class="" wire:loading wire:target="NewName">
                          @include('includes.simpleLoading')
                        </div>
                        </div>
                      </div> 
                    @endif
                  </div>
                </div>
              </div>
               <x-noMessages/>
            </div> 
        </div>
    </div>
</div>  

@push('style')
<link rel="stylesheet" href="{{ asset('emojis/dist/emojionearea.min.css') }}">
    <style type="text/css"> 
.sending-button{
    position: absolute;
    right: 0px;
    bottom: 15px;
}
.noMessageSelected{
    position: absolute;
    left: 30%;
    margin-top: 20%;
    color: #1260CC; 
} 
.noMessageSelected span{
  position: relative;
}
.borderlist{
    margin-top:1px ;/*
    border:1px solid  #1260CC;;*/ 
} 

.borderlist:hover{
     border-left: 4px solid #1260CC; 
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
    display: block; 
    line-height: 28px;
    font-size: 12px;
    font-weight: 600; 
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
  overflow: hidden; 
  overflow-y: auto;
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
  width: 100%;
  padding: 15px 5px;
  font-size: 14px;
  text-align: center;
  border-right: 1px solid rgba(0,0,0,0.1);
  background-color: rgba(255,255,255,0.75);
  cursor: pointer;
  font-weight: 700;
}
#inbox{ 
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
  height: calc(100vh - 218px);
  width: 325px;
  direction: rtl;
  overflow-y: scroll; 
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
   
  display: block; 
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
  width: calc(100% - 305px);
  float: right;
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
  padding: 3px 13px 10px 13px;
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

*{
  font-size: 15px;
}
    </style>
    @endpush

    @push('js')
    <script type="text/javascript" src="{{ asset('emojis/dist/emojionearea.min.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $("#textarea").emojioneArea({
         standalone: true,
         emojiPlaceholder: ":smile_cat:",
         placeholder: "Type something here",
         pickerPosition: "bottom",
          searchPosition: "bottom"
    });
  });
</script>
    @endpush