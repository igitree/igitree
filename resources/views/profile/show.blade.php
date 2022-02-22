<x-app-layout>
    <div class="row m-3 justify-content-center">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __(auth()->user()->u_fullname. ' Welcome to your Profile') }}
            </h2>
        </x-slot>
        <div class="col-lg-12 mt-2">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="my-4">
                                    <strong class="mb-0">
                                        Personal code
                                    </strong>
                                    <input class="form-control" id="myInputCode" type="text" value="{{auth()->user()->u_id}}">
                                        <button class="bg-dark mt-2 btn btn-sm btn-default" id="myButtin" onclick="CopyPersonalCodes()">
                                            Copy code
                                        </button>
                                    </input>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                    $family=DB::table('family__creators')->where('user_id',auth()->user()->u_id)->get()->first();
                @endphp 
                @if(!empty($family))
                    <div class="col-lg-5 ">
                        You have created
                        <span class="badge bg-dark">
                            1
                        </span>
                        family
                        <div class="my-4">
                            <strong class="mb-0">
                                Family code
                            </strong>
                            <input class="form-control" id="myInputfamily" type="text" value="{{$family->id}}">
                                <button class="bg-dark mt-2 btn btn-sm btn-default" id="myButtin1" onclick="CopyFamilyCodes()">
                                    Copy code
                                </button>
                            </input>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-5 mt-2">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')
            <x-jet-section-border>
            </x-jet-section-border>
            @endif
        </div>
        @if(auth()->user()->oauth_type=='')
        <div class="col-lg-5 ml-3 mt-2">
            <div class="row"> 
                <div class="col-lg-12">
                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords())) 
                    @livewire('profile.update-password-form')
                    <x-jet-section-border>
                    </x-jet-section-border>
                    @endif
                </div>
                <div class="col-lg-12 mt-2">
                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    @livewire('profile.two-factor-authentication-form')
                    <x-jet-section-border>
                    </x-jet-section-border>
                    @endif
                </div>
                <div class="col-lg-12 mt-2">
                    @livewire('profile.logout-other-browser-sessions-form')
           
                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    <x-jet-section-border>
                    </x-jet-section-border>
                    @livewire('profile.delete-user-form')
                     
                @endif
                </div>
            </div>
        </div>
        @endif


    </div>
</x-app-layout>
@push('style')
<style type="text/css">
    .tooltip {
  position: relative;
  display: inline-block;
}

.tooltip .tooltiptext {
  visibility: hidden;
  width: 140px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  bottom: 150%;
  left: 50%;
  margin-left: -75px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
@endpush 
