
<div class="container" >
    <div class="row mt-4 justify-content-center">
        <div class="col-lg-12"> 
        </div>
        <div class="col-lg-9 ">
            <div class="card shadow-sm">
              <div class="card-body">
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Ancestory personal info</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Family code</button>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <form wire:submit.prevent="searching" class="row">
                        <div class="col-lg-6">
                          <label>Fullnames</label>
                          <input type="text" placeholder="Type  names" class="form-control" wire:model.defer="u_fullname">
                        </div>
                        <div class="col-lg-6">
                          <label>Email</label>
                          <input type="text" placeholder="Type  Email" class="form-control" wire:model.defer="u_email">
                        </div> 
                         <div class="col-lg-6">
                          <label>Date of birth</label>
                          <input type="date" class="form-control" wire:model.defer="u_dob">
                        </div>
                        <div class="col-lg-6 mt-2">
                          <p class="badge badge-{{ ($AddSpouse)?'danger':'default'}}" wire:click=" {{ ($AddSpouse)?'RemoveFiltersSpouse':'AddFiltersSpouse'}}">
                            @if($AddSpouse) <i class="fa fa-times"></i> @else<i class="fa fa-plus"></i>@endif {{ ($AddSpouse)?'Remove':'Add'}} spouse
                          </p>
                          {{-- <p class="badge badge-default ml-3"><i class="fa fa-plus"></i>Add Child</p> 
 --}}

                          {{-- spouse address --}}
                          <div class="row" >
                            @if($AddSpouse) 
                            <div class="col-lg-12">
                              <label>Spouse Names</label>
                              <input type="text" placeholder="Type in spouse  fullnames" class="form-control" wire:model.defer="s_names">
                            </div>
                            <div class="col-lg-12">
                              <label>Spouse Email Address</label>
                              <input type="text" placeholder="Type in spouse email" class="form-control" wire:model.defer="s_email">
                            </div>
                            <div class="col-lg-12">
                              <label>Phone Address</label>
                              <input type="text" placeholder="Type phone number" class="form-control" wire:model.defer="s_phone">
                            </div> 
                            @endif  
                          {{-- Children --}} 
                          </div> 

                        </div>
                       <div class="col-lg-6"><button class="btn btn-sm btn-default mt-2">Make search</button>
                        </div>                        
                    </form>
                  </div>
                  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                      <form class="row" wire:submit.prevent="searching">
                        <div class="col-lg-12 mt-4">
                          <label>Family code </label>
                            <input type="text" placeholder="Type in Family code" class="form-control" wire:model.defer="f_code">
                        </div>
                         <div class="col-lg-6"><button class="btn btn-sm btn-default mt-2">Make search</button></div>
                      </form>
                  </div>
                </div> 
              </div>
            </div>
        </div>
        <div class="col-lg-9 mt-3">  
          @if($family)
            @if(!empty($family))
                <div class="row">
                  <div class="col-12">
                      <div class="card card-margin shadow-sm">
                          <div class="card-body">
                              <div class="row search-body">
                                  <div class="col-lg-12">
                                      <div class="search-result">
                                          <div class="result-header">
                                              <div class="row">
                                                  <div class="col-lg-6">
                                                      <div class="records">All results for @if($u_fullname)<span class="badge badge-default">{{$u_fullname}} @endif @if($u_email)</span> <span class="badge badge-default ml-1">{{$u_email}}<span>@endif</div>
                                                  </div>
                                                  <div class="col-lg-6">
                                                      <div class="result-actions">
                                                          {{-- <div class="result-sorting">
                                                              <span>Sort By:</span>
                                                              <select class="form-control border-0" id="exampleOption">
                                                                  <option value="1">Relevance</option>
                                                                  <option value="2">Names (A-Z)</option>
                                                                  <option value="3">Names (Z-A)</option>
                                                              </select>
                                                          </div>  --}}
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="result-body">
                                              <div class="row">
                                                <div class="col-lg-9">
                                                   @forelse($family as $families) 
                                                      <div class="d-flex flex-column m-3">
                                                          <a href="{{ route('singleprofile',$families->f_id)}}" class="mr-2">
                                                            <strong>#</strong> {{ $families->u_fullname }}
                                                          </a> 
                                                          <div class="ml-2">
                                                            <div class="d-flex flex-column">
                                                              <div>
                                                                <p class="type m-0 text-muted">
                                                                  @if($families->f_fathers and $families->f_mothers)<small>Has both parents</small> @elseif($families->f_fathers and empty($families->f_mothers))<small>Has father</small> @elseif(empty($families->f_fathers) and !empty($families->f_mothers)) <small>Has mother</small> @endif
                                                                </p>
                                                                <p class="text-muted m-0"><span class="location">@if(!empty($families->f_wives))
                                                                    <small>Has wife</small>
                                                                  @elseif(!empty($families->f_husbands))
                                                                    <small>Has Husband</small>
                                                                  @endif</span>
                                                                </p>
                                                              </div>
                                                              <div>
                                                              @if(!empty($WivesorHusbands))
                                                                @forelse($WivesorHusbands as $WH)
                                                                   {{--  @if($WH->f_id == $families->f_wives or $WH->f_id == $families->f_husbands )  --}}
                                                                  Maried to {{ $WH->u_fullname}} 
                                                                  {{-- @endif   --}} 
                                                                  @empty
                                                                  <span class="text-danger">No spouse found, Provided inforamtion on spouse doesn't much any</span>
                                                                @endforelse
                                                              @endif
                                                              </div>
                                                            </div>
                                                            
                                                          </div> 
                                                          <div>
                                                            @if(auth()->user())
                                                              <button href="#" data-target="#showRequestModel" wire:click="showrequestForm('{{$families->u_id }}')" class="btn btn-sm btn-default"> Send Request 
                                                                </button> 
                                                              @else
                                                                <a href="{{route('login')}}" target="_blank">Login/register to join</a>
                                                            @endif
                                                          </div>
                                                      </div>
                                                      @if($FamilyMemberSuggestions)
                                                        Other family relatives suggested
                                                          @forelse($FamilyMemberSuggestions as $familiesSug)
                                                            @if($familiesSug->f_id != $families->f_id)
                                                            <div class="d-flex flex-row m-3">
                                                                <div class="mr-2">
                                                                  <strong>#</strong>
                                                                </div>
                                                                <a href="{{ route('singleprofile',$familiesSug->f_id)}}" class="">
                                                                   {{ $familiesSug->u_fullname }}
                                                                </a>
                                                                <div class="ml-2">
                                                                  <p class="type m-0 text-muted">
                                                                    @if($familiesSug->f_fathers and $familiesSug->f_mothers)<small>Has both parents</small> @elseif($familiesSug->f_fathers and empty($familiesSug->f_mothers))<small>Has father</small> @elseif(empty($familiesSug->f_fathers) and !empty($familiesSug->f_mothers)) <small>Has mother</small> @endif
                                                                  </p>
                                                                  <p class="text-muted m-0"><span class="location">@if(!empty($familiesSug->f_wives))
                                                                      <small>Has wife</small>
                                                                    @elseif(!empty($familiesSug->f_husbands))
                                                                      <small>Has Husband</small>
                                                                  @endif</span></p>
                                                                </div> 
                                                            </div>
                                                            @endif
                                                          @empty
                                                            No user suggestions
                                                          @endforelse
                                                      @endif 
                                                     
                                                   @empty
                                                   <span class="text-muted">No results found</span>
                                                   @endforelse
                                                </div> 
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div> 
                          </div>
                      </div> 
                  </div>
              </div>
              @else
              <span class="text-muted">No results found</span>
            @endif
            @endif 
        </div>
    </div> 

@if($showrequestForm)
  <div class="card shadow-lg border p-3" id="showRequestModel" >
    <form method="post" class="card-body"  wire:submit.prevent="SendRequest">
      <div class="d-flex flex-row">
        <div class="flex-grow-1">
          <h5 class=" text-muted">Send Request to join Family</h5>
        </div> 
        <div>
          <button wire:keydown.escape="closerequestForm" wire:click.prevent="closerequestForm" class="btn btn-danger btn-sm">Close</button>
        </div>
      </div>
      <hr>
      @if($fRelation)Request will be sent as you are {{$fRelation}} of @if($to) sameone you provided info 
       @endif @endif
      <div class="row">
          <div class="col-lg-6">
            <label class="text-muted">From: </label>
            <input type="text" value="{{auth()->user()->u_fullname }}, {{auth()->user()->u_email }}" class="form-control" disabled> 
          </div> 
          <div class="col-lg-12 mt-2">
            @if($userTyped) 
              @forelse($userTyped as $user) To
              <span class="badge badge-success">{{$user->u_fullname}}</span>
              @empty  
                <label class="text-muted">Type in information of person you<br> are related to according to relation you choose </label>
                <small class="text-muted">Example: email , phone, fullnames</small>
                <input type="text" class="form-control"wire:model.defer="to"> 
              @endforelse
            @endif
          </div> 
          <div class="col-lg-12">
            <label class="text-muted">Relation </label>
            <select class="form-control" wire:model.defer="fRelation" wire:change="" required>
              <option value="">choose</option>
              <option>Father</option>
              <option>Mother</option>
              <option>Child</option>
              <option>Sibling</option>
              <option>Husband</option>
              <option>Wife</option>
            </select>
          </div>
          <div class="col-lg-12 mt-2"> 
            <label class="text-muted">Additional information</label>
            <textarea type="text" class="form-control"wire:model.defer="fAInfo" ></textarea>
          </div> 
          
      </div> 
      <p class="p-2 mt-2 alert-warning">Your request will be approved by creator of family.</p>
      <div>
          <button class="btn btn-sm btn-default" type="submit">Send</button>
      </div>
    </form> 
  </div> 
  @endif
</div> 

@push('style')
<style type="text/css">
  
</style>
@endpush