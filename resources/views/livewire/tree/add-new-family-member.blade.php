<div class="container-fluid">
    <div class="row mt-3 justify-content-center"> 
            <form class="col-lg-8 mr-2 card bg-white p-0 shadow-sm" wire:submit.prevent="AddNewFamilyMember">
                <div class="card-body d-flex flex-row">
                    <div class="flex-grow-1">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Family member of {{ $familyFMOnTree->u_fullname }}
                        </h5>
                    </div>
                    <div>
                        <label>{{-- if user is already registered use his/her code --}} change the way to add family member</label>
                        <select wire:model="AdduserByCode" wire:change="changeTheWayToAddUser"> 
                            <option value="info">Add user info</option>
                            <option value="code">Add user code</option>
                        </select>
                    </div>
                   
                   
                </div>
                <div class="card-body">
                     @if(!empty($messages))
                           <strong>
                                {{ $messages }} of {{ $familyFMOnTree->u_fullname }}
                            </strong>
                    @endif
                   
                     <div class="form-group col-md-6">
                        <label class="form-label" for="Gender">
                            Relation
                        </label>
                        <select class="form-control" value="{{ old('relation') }}" wire:model.change="messages" wire:model.defer="state.relation">
                            <option value="">
                                Choose Relation
                            </option>
                            <option>
                                Father
                            </option>
                            <option>
                                Mother
                            </option>
                            <option>
                                Child
                            </option>
                            @if($familyFatherAndMother) 
                       @if($familyFatherAndMother->f_fathers != null and $familyFatherAndMother != null)
                            <option>
                                Sibling 
                            </option>
                            @endif
                        @endif
 
                       @if($familyFMOnTree->u_gender == 'Female')
                            <option>
                                Husband
                            </option>
                            @elseif($familyFMOnTree->u_gender == 'Male')
                            <option>
                                Wife
                            </option>
                         @endif 
                        </select>
                        @error('relation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    @if($AdduserByCode=='info') 
                        <div class="form-row "> 
                            <div class="form-group col-md-6">
                                <label class="form-label col-lg-12" for="fullName">
                                    Full Name
                                </label>
                                <input class="form-control col-lg-12" id="firstName" placeholder="First Name" type="text" value="{{ old('fullname') }}" wire:model.defer="state.fullname">
                                    @error('fullname')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror 
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label col-lg-12" for="dob">
                                    Date of birth
                                </label>
                                <input class="form-control col-lg-12" type="date" value="{{ old('dob') }}" wire:model.defer="state.dob">
                                    @error('dob')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror 
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label col-lg-12" for="email">
                                    Email 
                                </label>
                                <input class="form-control col-lg-12" id="email" placeholder="Email" type="email" value="{{ old('email') }}" wire:model.defer="email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror 
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label col-lg-12" for="phone">
                                    Phone 
                                </label>
                                <input class="form-control col-lg-12" id="phone" placeholder="Phone" type="tel" value="{{ old('phone') }}" wire:model.defer="phone">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror 
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label col-lg-12" for="Address">
                                    Address
                                </label> 
                                 <div class="search-panel">
                                    <div class="search-panel__filters">
                                      <div id="clear"></div>
                                    </div>
                                    <div class="search-panel__results">
                                      <input id="searchbox" placeholder="Address" type="text" value="{{ old('address') }}" wire:model.defer="state.address" class="form-control" /> 
                                       {{-- <div id="maps"></div> --}}
                                    </div>
                                  </div>
                                 @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror 
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label col-lg-12" for="Gender">
                                    Gender
                                </label>
                                <select class="form-control" value="{{ old('gender') }}" wire:model.defer="state.gender">
                                    <option class="disabled" value="">
                                        Choose Gender
                                    </option>
                                    <option>
                                        Female
                                    </option>
                                    <option>
                                        Male
                                    </option>
                                </select>
                                @error('gender')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label class="form-label col-lg-12" for="country">
                                    Country
                                </label>
                                <input class="form-control col-lg-12" id="Country" placeholder="Country" type="text" value="{{ old('country') }}" wire:model.defer="state.country">
                                    @error('country')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror 
                            </div>
                        </div>
                    @else
                        <div class="form-group col-md-6">
                            <label>Enter user code</label>
                            <input type="text" wire:model="code" class="form-control">
                            <p wire:click="checkcodes" class="btn btn-sm btn-default mt-2">check code</p>
                        </div>

                        @if($FindUserCodes)
                        @if(!empty($FindUserCodes))
                            <span class="text-muted">Records found:</span>
                            <div class="d-flex flex-column border p-2 text-truncate mt-2"> 
                                <div class="d-flex flex-row" wire:loading.remove="">
                                        <div class="text-truncate flex-grow-1">
                                            {{ $FindUserCodes->u_fullname }}
                                         
                                            <small class="text-muted">
                                                {{ $FindUserCodes->u_email   }}
                                            </small>
                                        
                                        </div> 
                                    </div> 
                            </div>
                            @else
                             <span class="text-muted">No records found:</span> 
                        @endif 
                    @else
                    @endif


                    @endif
                </div>
                <div class="card-footer justify-content-end">
                    <button class="btn btn-sm btn-danger" data-bs-dismiss="modal" type="button">
                        Close
                    </button>
                    <button class="btn btn-sm btn-default" type="submit">
                        Save
                    </button>
                </div>
            </form>
            

        <div class="col-lg-3">
            <div class="card p-0 shadow-sm">
                <div class="card-body">
                    Relatives
                </div>
                <div class="card-body">
                    <div class="d-flex flex-row">
                        <div class="flex-grow-1">
                            <p class="text-muted">
                                If any relative found they will be displayed here.
                            </p>
                        </div>
                    </div>
                    <div>
                        @include('includes.loading')
                    </div>
                    <hr>
                    @if($RetrieveRelativesFamily)
                        @if(!empty($RetrieveRelativesFamily))
                        <div class="d-flex flex-column border p-2 text-truncate mt-2">
                            <div class="d-flex flex-row" wire:loading.remove="">
                                <div class="text-truncate flex-grow-1">
                                    {{ $RetrieveRelativesFamily[0]->u_fullname }}
                                    <br>
                                        <small class="text-muted">
                                            {{ $RetrieveRelativesFamily[0]->u_email   }}
                                        </small>
                                    </br>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-default">
                                        Join Family
                                    </button>
                                    <br>
                                        @if(!empty($MotherFatherSearched))
                                        <small>
                                            Parents available
                                        </small>
                                        @endif
                                    </br>
                                </div>
                            </div>
                            <div>
                            </div>
                        </div>
                        @endif 
                    @else
                    @endif
                    </hr>
                </div>
            </div>
        </div>
    </div>
</div>