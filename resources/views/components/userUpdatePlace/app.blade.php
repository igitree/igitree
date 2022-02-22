 <form class="p-6 border-t border-gray-200 md:border-t-0 md:border-l" wire:submit.prevent="UpdateUserProfile"> 
      <div class="bg-white     rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2"> 
        {{ 'Place of birth'}}
        <hr>
        <div class="-mx-3 md:flex mb-2 mt-3">
          <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
              eg:Kigali,Rwanda
            </label>
            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" wire:model.defer="state.place_birth" type="text" placeholder="Type in city and country">
            <select>
              @if($countries)
              @foreach($countries as $country)
              <option>{{ $countries->name }}</option>
              @endforeach
              @endif
            </select>
          </div>
        </div>
        <div class="-mx-3 md:flex mb-2 mt-3">   
          <div class="main flex  overflow-hidden m-4 select-none">
            <div class="title py-3 my-auto px-5 bg-blue-500  text-sm font-semibold mr-3">Select Gender</div>
            <label class="flex radio p-2 cursor-pointer">
              <input class="my-auto transform scale-125" wire:model.defer="state.place_birth" type="radio" name="place_birth" />
              <div class="title px-2">male</div>
            </label>

            <label class="flex radio p-2 cursor-pointer">
              <input class="my-auto transform scale-125" wire:model.defer="state.place_birth" type="radio" name="place_birth" />
              <div class="title px-2">female</div>
            </label>  
          </div>
        </div> 
        <div class="-mx-3 md:flex mb-2 mt-3">
          <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-city">
              Date of birth
            </label>
            <input class="appearance-none block w-full bg-grey-lighter text-grey-darker border border-grey-lighter rounded py-3 px-4" id="grid-city" wire:model.defer="state.place_birth" type="date" placeholder="Type in city and country">
          </div>
        </div>
        <div class="-mx-3 md:flex mb-2 mt-3">
          <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <button class="btn bg-blue-500 rounded-lg text-white font-bold  text-center px-4 py-3 transition duration-300 ease-in-out hover:bg-blue-600 mr-6">
              Save
          </button>
          </div>
        </div> 
      </div>
    </div>
</form>