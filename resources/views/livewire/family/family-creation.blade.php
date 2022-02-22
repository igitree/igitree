<section class="p-4">
  <div class="row justify-content-center">
    @if($created ==null)
    <div class="col-lg-12">
          @if (session()->has('message'))
            <div class="p-3 alert-success">
                {{ session('message') }} <span class="text-default">or</span>  <br>
                <form  method="POST" wire:submit.prevent="SaveFamily">
                  <button type="submit" class="btn btn-default btn-sm" wire:loading.attr="disabled">Create new Family</button>
                </form>
            </div>
      @else
          <form  method="POST" wire:submit.prevent="SaveFamily">
            <button type="submit" class="btn btn-default btn-sm"  wire:loading.attr="disabled">Create new Family </button> <span class="text-default">Or</span> 
          </form> 
        @endif
    </div>

    @endif
     <div class="col-lg-8 mt-3 ">
      <div class=" text-2xl text-center ">  
          <h2>Search Historical Records</h2>   
      </div>  
      <div  class="text-center">
          <em class="text-muted ">Connect to your ancestory family created before. all you need to do is to send request and you will be added after the approval of family creater</em>
        </div>
    </div>  
  </div> 
  <div class="loading">
      @include('includes.loading')
  </div> 
 
<div class="container">
  <div class="row">
      <div class="col-lg-12 card-margin">
          <div class="card search-form">
              <div class="card-body p-0">
                  <form id="search-form">
                      <div class="row">
                          <div class="col-12">
                            @if($name)
                              <span class="badge badge-primary">{{$name}} </span>
                            @endif 
                              <div class="row  justify-content-center">
                                <div>! Results will be shown as you type in</div>
                                <div class="col-lg-2 col-md-6 col-sm-12 p-2">
                                      <select class="form-control" wire:change.prevent="switchSearch" wire:model.defer="searchBy"> 
                                        <option value="{{ 'FamilyId' }}">Family Code</option> 
                                      </select>
                                  </div>  
                                    <div class="col-lg-5 col-md-6 col-sm-12 p-2">
                                      <input type="text" placeholder="Type in Family Code..."wire:model.defer="familyId"  class="form-control" id="search" name="search" wire:keydown="searching">
                                  </div> 
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  @if(!empty($familyId))
    @if(!empty($family))
        <div class="row justify-content-center">
          <div class="col-lg-10">
              <div class="card card-margin">
                  <div class="card-body">
                      <div class="row search-body">
                          <div class="col-lg-12">
                              <div class="search-result">
                                  <div class="result-header">
                                      <div class="row">
                                          <div class="col-lg-6">
                                              <div class="records">Results found</div>
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
                                      <div class="table-responsive">
                                          <table class="table widget-26">
                                              <tbody> 
                                                @forelse($family as $families)
                                                  <tr>
                                                      <td>
                                                          <div class="widget-26-job-emp-img">
                                                            <strong>##</strong>
                                                          </div>
                                                      </td>
                                                      <td>
                                                          <div class="widget-26-job-title">
                                                              <a href="#">{{ $families->u_fullname }}</a>
                                                              <p class="m-0"><a href="#" class="employer-name">{{'family creator'}}</a> 
                                                                <span class="text-muted time">
                                                                @if($families->created_at)
                                                                    {{$families->created_at}}
                                                                  @endif
                                                              </span></p>
                                                          </div>
                                                      </td>
                                                      <td>
                                                          <div class="widget-26-job-info">
                                                              <p class="type m-0">@if($families->f_fathers and $families->f_mothers)Have both parents @elseif($families->f_fathers and empty($families->f_mothers))Has father @elseif(empty($families->f_fathers) and !empty($families->f_mothers)) Has mother @endif</p>
                                                              <p class="text-muted m-0"><span class="location"></span></p>
                                                          </div>
                                                      </td>
                                                      <td>
                                                          <div class="widget-26-job-salary">{{-- $ 50/hr --}}</div>
                                                      </td>
                                                      <td>
                                                          <div class="widget-26-job-category bg-soft-base"> 
                                                              <span>{{$families->u_email}}</span>
                                                          </div>
                                                      </td>
                                                      <td>
                                                          <div class="widget-26-job-starred">
                                                            @if($checkexistance) 
                                                              @if($checkexistance->accepted == 0)
                                                                <button href="#" data-target="#showRequestModel" wire:click="showrequestForm('{{$families->id }}')"
                                                                  class="btn btn-default btn-sm" {{$checkexistance==null? '':'disabled' }}>
                                                                    @if(empty($checkexistance)) 
                                                                      Send request
                                                                     @else Requested @endif
                                                                </button>
                                                              @elseif($checkexistance->accepted==1) 
                                                                
                                                              <div class="widget-26-job-category bg-soft-base"> 
                                                                    <span>Approved</span>
                                                                </div>
                                                              @endif
                                                              @else
                                                                <button href="#" data-target="#showRequestModel" wire:click="showrequestForm('{{$families->id }}')"
                                                                  class="btn btn-default btn-sm" {{$checkexistance==null? '':'disabled' }}>
                                                                    @if(empty($checkexistance)) 
                                                                      Send request
                                                                     @else Requested @endif
                                                                </button>
                                                              @endif
                                                          </div>
                                                      </td>
                                                  </tr> 
                                                  @empty
                                                  No Family records found, create new   family                                              
                                                @endforelse
                                              </tbody>
                                          </table>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div> 
                  </div>
              </div>
          </div>
      </div>
    @endif
    @endif
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
            <label class="text-muted">Type in information of person you<br> are related to according to relation you choose </label>
            <small class="text-muted">Example: email , phone, fullnames</small>
            <input type="text" class="form-control"wire:model.defer="to" wire:keydown="searchingTypedUser">
            <small wire:loading>Searching user</small>
            @if($userTyped)
              @forelse($userTyped as $user)
              <span class="badge badge-success">{{$user->u_fullname}}</span>
              @empty
                <span class="badge badge-danger">No user found</span>
              @endforelse
            @endif
          </div> 
          <div class="col-lg-6 mt-2"> 
            <label class="text-muted">Additional information</label>
            <textarea type="text" class="form-control"wire:model.defer="fAInfo" ></textarea>
          </div> 
          <div class="col-lg-6">
            <label class="text-muted">Relation </label>
            <select class="form-control" wire:model.defer="fRelation" required>
              <option value="">choose</option>
              <option>Father</option>
              <option>Mother</option>
              <option>Child</option>
              <option>Sibling</option>
              <option>Husband</option>
              <option>Wife</option>
            </select>
          </div>
      </div> 
      <p class="p-2 mt-2 alert-warning">Your request will be approved by creator of family.</p>
      <div>
          <button class="btn btn-sm btn-default" type="submit">Send</button>
      </div>
    </form> 
  </div> 
  @endif
</section> 
@push('style')

    <style type="text/css">
    
      body {
        position: relative;
      }
     .loading{
        position:absolute;
        right: 80px;
        top: 30px;
     }
.widget-26 {
  color: #3c4142;
  font-weight: 400;
}

.widget-26 tr:first-child td {
  border: 0;
}

.widget-26 .widget-26-job-emp-img img {
  width: 35px;
  height: 35px;
  border-radius: 50%;
}

.widget-26 .widget-26-job-title {
  min-width: 200px;
}

.widget-26 .widget-26-job-title a {
  font-weight: 400;
  font-size: 0.875rem;
  color: #3c4142;
  line-height: 1.5;
}

.widget-26 .widget-26-job-title a:hover {
  color: #68CBD7;
  text-decoration: none;
}

.widget-26 .widget-26-job-title .employer-name {
  margin: 0;
  line-height: 1.5;
  font-weight: 400;
  color: #3c4142;
  font-size: 0.8125rem;
  color: #3c4142;
}

.widget-26 .widget-26-job-title .employer-name:hover {
  color: #68CBD7;
  text-decoration: none;
}

.widget-26 .widget-26-job-title .time {
  font-size: 12px;
  font-weight: 400;
}

.widget-26 .widget-26-job-info {
  min-width: 100px;
  font-weight: 400;
}

.widget-26 .widget-26-job-info p {
  line-height: 1.5;
  color: #3c4142;
  font-size: 0.8125rem;
}

.widget-26 .widget-26-job-info .location {
  color: #3c4142;
}

.widget-26 .widget-26-job-salary {
  min-width: 70px;
  font-weight: 400;
  color: #3c4142;
  font-size: 0.8125rem;
}

.widget-26 .widget-26-job-category {
  padding: .5rem;
  display: inline-flex;
  white-space: nowrap;
  border-radius: 15px;
}

.widget-26 .widget-26-job-category .indicator {
  width: 13px;
  height: 13px;
  margin-right: .5rem;
  float: left;
  border-radius: 50%;
}

.widget-26 .widget-26-job-category span {
  font-size: 0.8125rem;
  color: #3c4142;
  font-weight: 600;
}

.widget-26 .widget-26-job-starred svg {
  width: 20px;
  height: 20px;
  color: #fd8b2c;
}

.widget-26 .widget-26-job-starred svg.starred {
  fill: #fd8b2c;
}
.bg-soft-base {
  background-color: #e1f5f7;
}
.bg-soft-warning {
    background-color: #fff4e1;
}
.bg-soft-success {
    background-color: #d1f6f2;
}
.bg-soft-danger {
    background-color: #fedce0;
}
.bg-soft-info {
    background-color: #d7efff;
}


.search-form {
  width: 80%;
  padding: 20px;
  margin: 0 auto;
  margin-top: 1rem;
}
 
.search-form select:focus {
  border: 0;
}

.search-form button {
  height: 100%;
  width: 100%;
  font-size: 1rem;
}

tr:hover{
  background-color:#f1f1f1;
  cursor: pointer;
}
.search-form button svg {
  width: 24px;
  height: 24px;
}

.search-body {
  margin-bottom: 1.5rem;
}

.search-body .search-filters .filter-list {
  margin-bottom: 1.3rem;
}

.search-body .search-filters .filter-list .title {
  color: #3c4142;
  margin-bottom: 1rem;
}

.search-body .search-filters .filter-list .filter-text {
  color: #727686;
}

.search-body .search-result .result-header {
  margin-bottom: 2rem;
}

.search-body .search-result .result-header .records {
  color: #3c4142;
}

.search-body .search-result .result-header .result-actions {
  text-align: right;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.search-body .search-result .result-header .result-actions .result-sorting {
  display: flex;
  align-items: center;
}

.search-body .search-result .result-header .result-actions .result-sorting span {
  flex-shrink: 0;
  font-size: 0.8125rem;
}

.search-body .search-result .result-header .result-actions .result-sorting select {
  color: #68CBD7;
}

.search-body .search-result .result-header .result-actions .result-sorting select option {
  color: #3c4142;
}

@media (min-width: 768px) and (max-width: 991.98px) {
  .search-body .search-filters {
    display: flex;
  }
  .search-body .search-filters .filter-list {
    margin-right: 1rem;
  }
}

.card-margin {
    margin-bottom: 1.875rem;
}

@media (min-width: 992px){
.col-lg-2 {
    flex: 0 0 16.66667%;
    max-width: 16.66667%;
}
}

.card-margin {
    margin-bottom: 1.875rem;
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #ffffff;
    background-clip: border-box;
    border: 1px solid #e6e4e9;
    border-radius: 8px;
}
    </style>
@endpush