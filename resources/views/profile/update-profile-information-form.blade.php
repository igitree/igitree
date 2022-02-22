<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="form" class="col-lg-12">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />
                <br>
                <x-jet-label for="photo" value="{{ __('Upload Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->u_fullname }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif


        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="u_fullname" value="{{ __('Name') }}" />
            <x-jet-input id="u_fullname" type="text" class="mt-1 block w-full" wire:model.defer="state.u_fullname" autocomplete="u_fullname" />
            <x-jet-input-error for="u_fullname" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="u_email" value="{{ __('Email') }}" />
            <x-jet-input id="u_email" type="email" class="mt-1 block w-full" wire:model.defer="state.u_email" />
            <x-jet-input-error for="u_email" class="mt-2" />
        </div>

        <!-- DOB -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="u_dob" value="{{ __('Data of birth') }}" />
            <x-jet-input id="u_dob" type="date" class="mt-1 block w-full" wire:model.defer="state.u_dob" />
            <x-jet-input-error for="u_dob" class="mt-2" />
        </div> 
         <!-- u_address -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="u_address" value="{{ __('Address') }}" />
            <x-jet-input id="u_address" type="text" class="mt-1 block w-full" wire:model.defer="state.u_address" />
            <x-jet-input-error for="u_address" class="mt-2" />
        </div>

        <!-- u_phoneline -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="u_phoneline" value="{{ __('Phone number') }}" />
            <x-jet-input id="u_phoneline" type="text" class="mt-1 block w-full" wire:model.defer="state.u_phoneline" />
            <x-jet-input-error for="u_phoneline" class="mt-2" />
        </div>
 

        <!-- u_gender -->
        <div class="col-span-6 sm:col-span-4 mt-2 mb-2">
            <x-jet-label for="u_gender" value="{{ __('Gender') }}" />
            <x-jet-input id="u_gender" type="radio" wire:model.defer="state.u_gender" name="u_gender" value="{{'Female'}}" />Female
            <x-jet-input id="u_gender" type="radio" wire:model.defer="state.u_gender"  name="u_gender" value="{{'Male'}}"/>Male
            {{-- 
            <select  class="mt-1 block w-full"><option>Male</option><option>Female</option></select> --}}
            <x-jet-input-error for="u_gender" class="mt-2" />
        </div>

        <!-- u_country -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="u_country" value="{{ __('Country') }}" />
            <x-jet-input id="u_country" type="text" class="mt-1 block w-full" wire:model.defer="state.u_country" />
            <x-jet-input-error for="u_country" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
