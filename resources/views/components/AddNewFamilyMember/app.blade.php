<form wire:submit.prevent="AddNewFamilyMember({{ $showEditModelUser }})"> 
  <div class="modal-header">
    <h5 class="modal-title" id="staticBackdropLabel">
      Family member {{ $showEditModelUser }}
    </h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body"> 
    <div class="col-sm-5 text-danger">
        @if(session('message_error'))
          {{ session('message_error') }} 
        @endif
      </div> 
      
       <div class="form-row "> 
         <div class="form-group col-md-6">  
             <label for="Gender" class="form-label col-lg-12">Relation</label>
             <select class="form-control" wire:model.defer="state.relation" required>
               <option class="disabled">Choose Relation</option>
               <option>Father</option>
               <option>Mother</option>
               <option>Child</option>
               <option>Wife</option>
             </select> 
              @error('relation')
                 <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
             </div>  
             <div class="form-group col-md-6">  
                 <label for="firstName" class="form-label col-lg-12">Full Name</label>  
                 <input type="text" class="form-control col-lg-12" wire:model.defer="state.fullname" id="firstName" placeholder="First Name"  required>
                  @error('fullname')
                     <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror  
             </div>  
             <div class="form-group col-md-6">  
                 <label for="dob" class="form-label col-lg-12">DOB</label>  
                 <input type="date" class="form-control col-lg-12" wire:model.defer="state.dob" required>  
                 @error('dob')
                     <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
             </div>  
            <div class="form-group col-md-6">  
                 <label for="email" class="form-label col-lg-12">Email  Id</label>  
                 <input type="email" class="form-control col-lg-12"  wire:model.defer="email" id="email" placeholder="Email" required>  
                 @error('email')
                     <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
             </div> 
             <div class="form-group col-md-6">  
                 <label for="phone" class="form-label col-lg-12">Phone  Id</label>  
                 <input type="tel" class="form-control col-lg-12" wire:model.defer="phone"   id="phone" placeholder="Phone" required> 
                 @error('phone')
                     <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror 
             </div>  
            <div class="form-group col-md-6">  
                 <label for="Address" class="form-label col-lg-12">Address</label>  
                 <input type="text" class="form-control col-lg-12" wire:model.defer="state.address" id="Address" placeholder="Address" required>  
                 @error('address')
                     <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror
            </div>   
            <div class="form-group col-md-6">  
                 <label for="Gender" class="form-label col-lg-12">Gender</label>   
                  <select class="form-control" wire:model.defer="state.gender" required>
                    <option class="disabled">Choose Gender</option>
                    <option>Female</option>
                    <option>Male</option>
                  </select> 
                 @error('gender')
                     <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror 
             </div>  

            <div class="form-group col-md-6"> 
                <label for="country" class="form-label col-lg-12">Country</label>  
                <input type="text" class="form-control col-lg-12" wire:model.defer="state.country" id="Country" placeholder="Country" required> 
                @error('country')
                     <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                    @enderror    
           </div>  
      </div>
  
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-sm btn-default"> Save
    </button>
  </div>
</form> 