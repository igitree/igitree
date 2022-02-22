<section class="p-4 tree"> 
    <div class="loading">
     @include('includes.loading')
    </div>
    @if($this->familyFMCheckdata !=0 and $this->familyFMCheckdata > 0)
    <div class="zoom-header">
        <div class="d-flex flex-row">
            <button class="btn btn-sm zoomout">
                <i class="fa fa-minus">
                </i>
            </button>
            <select class="pr-5 form-control select" id="sel" onchange="handleChange()">
                <option value="0.5">
                    50%
                </option>
                <option value="0.75">
                    75%
                </option>
                <option value="0.85">
                    85%
                </option>
                <option value="0.9">
                    90%
                </option>
                <option selected="" value="1">
                    100%
                </option>
                <option value="1.2">
                    120%
                </option>
                <option value="1.7">
                    150%
                </option>
                 <option value="1.9">
                    170%
                </option>
                 <option value="2">
                    200%
                </option>
                <option value="1">
                    reset
                </option>
            </select>
            <button class="btn btn-sm zoomin">
                <i class="fa fa-plus">
                </i>
            </button>
        </div>
    </div>
    <div class="main-container  justify-content-center row p-5">
        <div class="maindiv"> 
            <div class="tree">
                @if($MFtree)
                    @if($GGMGGFtree)
                        @forelse($GGMGGFtree as $GGMGGF)
                          <ul>
                            <li>
                                <div class="family"> 
                                    <div class="parent">
                                    @if($GMGF->u_gender == 'Female' or $GGMGGF->u_gender == 'Male')
                                      <div class="person {{($GGMGGF->u_gender == 'Male')?'  male':'child female'}} ">
                                        <div class="name">
                                            <a data-target="#showRequestModel"  href="#" wire:click="ShowUserInfo('{{ $GGMGGF->u_id  }}')">
                                               <div class="row">
                                                   <div class="col-lg-12 cardTop">
                                                       <span> 
                                                            {{ substr ($GGMGGF->u_fullname, 0,2) }}
                                                        </span>
                                                         <a href="{{route('newMember',$GGMGGF->u_id )}}" class="plus"><i class="fa fa-plus"></i></a>
                                                   </div>
                                                   <div class="col-lg-12 cardBottom text-truncate">
                                                        <small class="p-1 text-truncate"> 
                                                            <strong>
                                                               {{($GGMGGF->u_gender == 'Male')?'Grandfather':'GrandMother'}}
                                                            </strong> 
                                                        </small>
                                                   </div> 
                                                </div> 
                                            </a>
                                        </div>
                                      </div>

                                    @endif
                            @empty
                        @endforelse
                    @endif 

                    @if($GMGFtree)
                        @forelse($GMGFtree as $GMGF) 
                        <ul> 
                            <li>
                             <div class="family">
                                <div class="parent"> 
                                    @if($GMGF->u_gender == 'Female' or $GMGF->u_gender == 'Male')
                                      <div class="person {{($GMGF->u_gender == 'Male')?' child male':'female'}} ">
                                        <div class="name">
                                            <a data-target="#showRequestModel"  href="#" wire:click="ShowUserInfo('{{ $GMGF->u_id  }}')">
                                               <div class="row">
                                                   <div class="col-lg-12 cardTop">
                                                       <span> 
                                                            {{ substr ($GMGF->u_fullname, 0,2) }}
                                                        </span>
                                                         <a href="{{route('newMember',$GMGF->u_id )}}" class="plus"><i class="fa fa-plus"></i></a>
                                                   </div>
                                                   <div class="col-lg-12 cardBottom text-truncate">
                                                        <small class="p-1 text-truncate"> 
                                                            <strong>
                                                               {{($GMGF->u_gender == 'Male')?'Grandfather':'GrandMother'}}
                                                            </strong> 
                                                        </small>
                                                   </div> 
                                                </div> 
                                            </a>
                                        </div>
                                      </div>
                                    @endif 
                                @empty
                            @endforelse
                        @endif
                          <ul>
                            @endif 
                            @if($MFtree) 
                            @if(!empty($AUtree)) 
                            @forelse($AUtree as $AU)
                            
                                @if(auth()->user()->id != $AU->u_id) 
                                <li>   
                                        @if($AU->u_gender =='Female')
                                          <div class="person  {{($AU->u_gender == 'Male')?'male':'female'}} ">
                                            <div class="name">
                                                <a data-target="#showRequestModel"  href="#" wire:click="ShowUserInfo('{{ $AU->u_id  }}')">
                                                   <div class="row">
                                                       <div class="col-lg-12 cardTop">
                                                           <span> 
                                                                {{ substr ($AU->u_fullname, 0,2) }}
                                                            </span>
                                                             <a href="{{route('newMember',$AU->u_id )}}" class="plus"><i class="fa fa-plus"></i></a>
                                                       </div>
                                                       <div class="col-lg-12 cardBottom">
                                                            <small class="p-1"> 
                                                                <strong>
                                                                   {{($AU->u_gender == 'Male')?'Uncle':'Aunt'}}
                                                                </strong> 
                                                            </small>
                                                       </div> 
                                                    </div> 
                                                </a>
                                            </div>
                                          </div> 
                                      @endif
                                      <div class="parent">
                                        @if($AU->u_gender == 'Male')
                                            <div class="person  {{($AU->u_gender == 'Male')?'male':'female'}} ">
                                            <div class="name">
                                                <a data-target="#showRequestModel"  href="#" wire:click="ShowUserInfo('{{ $AU->u_id  }}')">
                                                   <div class="row">
                                                       <div class="col-lg-12 cardTop">
                                                           <span> 
                                                                {{ substr ($AU->u_fullname, 0,2) }}
                                                            </span>
                                                            <a href="{{route('newMember',$AU->u_id )}}" class="plus"><i class="fa fa-plus"></i></a>
                                                       </div>
                                                       <div class="col-lg-12 cardBottom">
                                                            <small class="p-1"> 
                                                                <strong>
                                                                   {{($AU->u_gender == 'Male')?'Uncle':'Aunt'}}
                                                                </strong> 
                                                            </small>
                                                       </div> 
                                                    </div> 
                                                </a>
                                            </div>
                                          </div>
                                        @endif
                                    </div> 
                                </li>
                                @endif
                            @empty
                            @endforelse
                            @endif
                            @endif  
                            <li>  
                            @if($MFtree) 
                            @forelse($MFtree as $MF) 
                                  <div class="family" style="width: 344px">
                                    @if($MF->u_gender == 'Female')
                                        <div class="person {{($MF->u_gender == 'Male')?'male':'child female'}} ">
                                            <div class="name">
                                                <a data-target="#showRequestModel"  href="#" wire:click="ShowUserInfo('{{ $MF->u_id  }}')">
                                                   <div class="row">
                                                       <div class="col-lg-12 cardTop">
                                                           <span> 
                                                                {{ substr ($MF->u_fullname, 0,2) }}
                                                            </span>
                                                             <a href="{{route('newMember',$MF->u_id )}}" class="plus"><i class="fa fa-plus"></i></a>
                                                       </div>
                                                       <div class="col-lg-12 cardBottom">
                                                            <small class="p-1"> 
                                                                <strong>
                                                                   {{($MF->u_gender == 'Male')?'Father':'Mother'}}
                                                                </strong> 
                                                            </small>
                                                       </div> 
                                                    </div> 
                                                </a>
                                            </div>
                                        </div>  
                                    @endif
                                    <div class="parent">
                                    @if($MF->u_gender == 'Male')
                                      <div class="person {{($MF->u_gender == 'Male')?'male':'child female'}} ">
                                        <div class="name">
                                            <a data-target="#showRequestModel"  href="#" wire:click="ShowUserInfo('{{ $MF->u_id  }}')">
                                               <div class="row">
                                                   <div class="col-lg-12 cardTop">
                                                       <span> 
                                                            {{ substr ($MF->u_fullname, 0,2) }}
                                                        </span>
                                                        <a href="{{route('newMember',$MF->u_id )}}" class="plus"><i class="fa fa-plus"></i></a>
                                                   </div>
                                                   <div class="col-lg-12 cardBottom">
                                                        <small class="p-1"> 
                                                            <strong>
                                                               {{($MF->u_gender == 'Male')?'Father':'Mother'}}
                                                            </strong> 
                                                        </small>
                                                   </div> 
                                                </div> 
                                            </a>
                                        </div>
                                      </div>
                                      @else
                                    @endif
                                @empty
                            @endforelse
                            @endif 
                                  <ul> 
                                    @forelse($familyFM as $Creator )

                                    <li> 
                                          <div class="person child {{($Creator->u_gender == 'Male')?'male':'female'}}">
                                            <div class="name">
                                                <a href="#" data-target="#showRequestModel"  wire:click="ShowUserInfo('{{ $Creator->u_id  }}')">
                                                   <div class="row">
                                                       <div class="col-lg-12 cardTop">
                                                           <span> 
                                                                {{ substr ($Creator->u_fullname, 0,2) }}
                                                            </span>
                                                            <a href="{{route('newMember',$Creator->u_id )}}" class="plus"><i class="fa fa-plus "></i></a>
                                                       </div>
                                                       <div class="col-lg-12 cardBottom">
                                                            <small class="p-1"> 
                                                                <strong>
                                                                   {{'You'}}
                                                                </strong> 
                                                            </small>
                                                       </div> 
                                                    </div> 
                                                </a>
                                            </div>
                                          </div>  

                                @if($wiveshusbandtree) 
                                    @if(!empty($wiveshusbandtree))
                                        <div class="parent">
                                            @forelse($wiveshusbandtree as $WHtree)
                                            @if($Creator->u_gender != $WHtree->u_gender) 
                                                <div class="person child {{($WHtree->u_gender == 'Male')?'male':'female'}}">
                                                    <div class="name">
                                                        <a href="#" data-target="#showRequestModel"  wire:click="ShowUserInfo('{{ $WHtree->u_id  }}')">
                                                           <div class="row">
                                                               <div class="col-lg-12 cardTop">
                                                                   <span> 
                                                                        {{ substr ($WHtree->u_fullname, 0,2) }}
                                                                    </span>
                                                                   <a href="{{route('newMember',$WHtree->u_id )}}" class="plus"><i class="fa fa-plus "></i></a>
                                                               </div>
                                                               <div class="col-lg-12 cardBottom">
                                                                    <small class="p-1"> 
                                                                        <strong>
                                                                           {{($WHtree->u_gender == 'Male')?'Husband':'Wife'}}
                                                                        </strong> 
                                                                    </small>
                                                               </div> 
                                                            </div> 
                                                        </a>
                                                    </div>
                                                  </div>  
                                                @if($children) 
                                                    <ul> 
                                                        @forelse($children as $child)

                                                        <li>
                                                          <div class="person  {{($child->u_gender == 'Male')?'child male':'child female'}}">
                                                            <div class="name">
                                                                <a href="#" data-target="#showRequestModel"  wire:click="ShowUserInfo('{{ $child->u_id  }}')">
                                                                   <div class="row">
                                                                       <div class="col-lg-12 cardTop">
                                                                           <span> 
                                                                                {{ substr ($child->u_fullname, 0,2) }}
                                                                            </span> 
                                                                       </div>
                                                                       <div class="col-lg-12 cardBottom">
                                                                            <small class="p-1"> 
                                                                                <strong>
                                                                                   {{($child->u_gender == 'Male')?'Son':'Daughter'}}
                                                                                </strong> 
                                                                            </small>
                                                                       </div> 
                                                                    </div> 
                                                                </a>
                                                            </div>
                                                          </div>

                                                         @if($childwifehusband) 
                                                          <div class="parent">
                                                                @forelse($childwifehusband as $HWwife)
                                                            
                                                                    <div class="person {{($child->u_gender == 'Male')?'child male':'female'}}">
                                                                        <div class="name">
                                                                            <a href="#" data-target="#showRequestModel"  wire:click="ShowUserInfo('{{ $HWwife->u_id  }}')">
                                                                           <div class="row">
                                                                               <div class="col-lg-12 cardTop">
                                                                                   <span> 
                                                                                        {{ substr ($HWwife->u_fullname, 0,2) }}
                                                                                    </span> 
                                                                               </div>
                                                                               <div class="col-lg-12 cardBottom">
                                                                                    <small class="p-1"> 
                                                                                        <strong>
                                                                                           {{($HWwife->u_gender == 'Male')?'Husband':'Wife'}}
                                                                                        </strong> 
                                                                                    </small>
                                                                               </div> 
                                                                            </div> 
                                                                        </a>
                                                                        </div>
                                                                      </div> 
                                                                   
                                                            @empty
                                                            
                                                        @endforelse
                                                    </div>
                                                @endif 

                                                        </li> 
                                                        @empty
                                                        {{-- No child --}}
                                                        @endforelse                                                
                                                      </ul>
                                                @endif  
                                                     
                                            @endif
                                            @empty
                                           {{--  No wife or husband --}}
                                            @endforelse
                                        </div> 
                                        @endif
                                    @endif  
                                    </li>
                                    @empty
                                   {{--  No user --}}
                                    @endforelse





                                    @if(!empty($Siblingtree)) 
                                        @forelse($Siblingtree as $sibling)
                                            @if($sibling->f_id != $Creator->f_id) 
                                                <li>
                                                  <div class="person child {{($sibling->u_gender == 'Male')?'male':'female'}}">
                                                    <div class="name">
                                                        <a data-target="#showRequestModel"  href="#" wire:click="ShowUserInfo('{{ $sibling->u_id  }}')">
                                                            <div class="row">
                                                               <div class="col-lg-12 cardTop">
                                                                   <span class=""> 
                                                                        {{ substr ($sibling->u_fullname, 0,2) }}
                                                                    </span> 
                                                                   <a href="{{route('newMember',$sibling->u_id )}}" class="plus"><i class="fa fa-plus "></i></a>
                                                               </div>
                                                               <div class="col-lg-12 cardBottom">
                                                                    <small class="p-1"> 
                                                                        <strong>
                                                                           {{($sibling->u_gender == 'Male')?'Bro':'Sis'}}
                                                                        </strong> 
                                                                    </small>
                                                               </div>  
                                                            </div> 
                                                        </a> 
                                                    </div>
                                                  </div>
                                                </li>                                            
                                            @endif
                                        @empty

                                        @endforelse
                                        @else
                                          {{--  <li>
                                              <div class="person child ">
                                                <div class="name">
                                                    <a href="#">
                                                        <div class="row">
                                                           <div class="col-lg-12 cardTop">
                                                               <span class=""> 
                                                                   N.E
                                                                </span> 
                                                                <i class="fa fa-plus plus">
                                                                </i>
                                                           </div>
                                                           <div class="col-lg-12 cardBottom">
                                                                <small class="p-1"> 
                                                                    <strong>
                                                                      New
                                                                    </strong> 
                                                                </small>
                                                           </div>  
                                                        </div> 
                                                    </a> 
                                                </div>
                                              </div>
                                            </li> --}} 
                                    @endif  
                                  </ul>
                                </div>
                                {{-- <div class="person spouse male">
                                  <div class="name">Spouse</div>
                                </div>  --}}
                              </div>
                            </li> 

                          </ul>
                        </div>
                    </div>
                </li>
            </ul>
             </div>
          </div>
        </li>
        </ul>
        </div> 
    </div>
</div> 
@if($showrequestForm)
    @if(!empty($users)) 
        @foreach($users as $user)
            <div class="card shadow-lg text-dark border p-3" id="showRequestModel" >
                <form method="post" class="card-body"  wire:submit.prevent="SendRequest">
                  <div class="d-flex flex-row">
                    <div class="flex-grow-1">
                      <h2>
                        {{ $user->u_fullname }}
                    </h2> 
                    </div> 
                    <div>
                      <button wire:keydown.escape="closerequestForm" wire:click.prevent="closerequestForm" class="btn btn-danger btn-sm">Close</button>
                    </div>
                  </div>
                  <hr>
                    <div class="row">
                        <div class="col-lg-6">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                @if(!empty($user->profile_photo_path)) 
                                 <img alt="jdfjh" class="img-circle medium-image" src="{{asset('storage/'.$user->profile_photo_path)}}" width="300" style="width:300px">
                                @else
                                    <img alt="" class="img-circle medium-image" src="{{asset('/assets/img/account.jpg')}}">
                                @endif
                            @else
                                <img alt="" class="img-circle medium-image" src="{{asset('/assets/img/account.jpg')}}">
                            @endif
                        </div>
                        <div class="col-lg-6"> 
                            <div class="row">
                                <div class="col-lg-12 text-left text-dark" > 
                                    <p>
                                        <strong>
                                            Date of Birth:
                                        </strong>
                                        {{  $user->u_dob }}
                                    </p> 
                                    <p>
                                        <strong>
                                            Email:
                                        </strong>
                                        {{  $user->u_email }}
                                    </p>
                                    <p>
                                        <strong>
                                            Gender:
                                        </strong>
                                        {{  $user->u_gender }}
                                    </p>
                                    <p>
                                        <strong>
                                            Country:
                                        </strong>
                                        {{  $user->u_country }}
                                    </p>
                                    <p>
                                        <strong>
                                            Address:
                                        </strong>
                                        {{  $user->u_address }}
                                    </p>
                                </div>
                            </div>
                            <div class="row"> 
                                <div class="col-lg-6 mt-1">   
                                        <a class="btn btn-sm border font-weight-bold btn-block shadow-md" href="{{route('newMember',$user->u_id )}}">  Add relatives
                                        </a>  
                                </div>
                                <div class="col-lg-6 mt-1">
                                    @if(auth()->user()->u_id != $user->u_id)
                                    <a class="btn btn-sm btn-block  btn-default" href="{{ route('chat.user', $user->u_id) }}">
                                        Send Message
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach 
    @endif
@endif 


@else
    <div class="row justify-content-center">
        <div class="mt-5 col-lg-4">
            <h4>
                It looks like you didn't have tree yet
            </h4>
            <em>
                Be the first to create it for your family
            </em>
            <div class="mt-4">
                <button class="btn btn-sm text-white btn-default btn-block" href="{{ route('family') }}" wire:click="proceed" wire:loading.attr="disabled">
                    Proceed now 
                </button>
            </div>
        </div>
    </div> 
    @endif
</section>
@push('style')
<style type="text/css">

body{
    overflow:auto;
        position: relative;
      }
.loading{
        position:absolute;
        right: 80px;
        top: 30px;
     }
.plus{
       color: white;
        background: #1260CC;
        padding: 2px; 
        position: absolute;
        top:-8px;
    }

.cardTop{
     position: relative;     
} 

.cardBottom{ margin-top: 10px;
    
}

/* Person image container  */
.person a span {
    border: 1px solid #1260CC;
    border-top:none;
    color: #666;
    padding: 10px;
    font-size: 15px; 
    width: 100%; 
    position: relative; 
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 500;
}

    /* Person */
.person { 
    border-right: 1px solid #ccc;
    padding-top: 7px;  
    background-color: #FFFFFF;
    display: inline-block; 
    width:70px;
    border-radius: 5px;
    text-decoration: :none;
    transition:.5s;
     position:relative;
      border: 1px solid green;
    box-shadow: 0px 0px  8px -px #5f5f5f;
}


.person.female {
    border-color: #F45B69;
}

.person.male {
    border-color: #1260CC;;
}

.person div {
    text-align: center;
}

.person .name {
    font-size: 16px;
}

.person .parentDrop, .person .spouseDrop, .person .childDrop {
    border: 1px dashed #000000;
    width: auto;
    min-width: 80px;
    min-height: 80px;
    display: inline-block;
    vertical-align: top;
    position: relative;
    padding-top: 15px;
}

.person .parentDrop>span,
.person .spouseDrop>span,
.person .childDrop>span {
    position: absolute;
    top: 2px;
    left: 2px;
    font-weight: bold;
}
.parentDrop>.person,
.spouseDrop>.person,
.childDrop>.person {
    margin-top: 20px;
}

/* Tree */
.tree ul {
    padding-top: 20px;
    position: relative;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}

.tree li {
    display: table-cell;
    text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
}



/*We will use ::before and ::after to draw the connectors*/
.tree li::before, .tree li::after {
    content: '';
    position: absolute;
    top: 0;
    right: 50%;
    border-top: 1px solid #ccc;
    width: 50%;
    height: 20px;
}

.tree li::after {
    right: auto;
    left: 50%;
    border-left: 1px solid #ccc;
}

/*We need to remove left-right connectors from elements without 
any siblings*/
.tree li:only-child::after, .tree li:only-child::before {
    display: none;
}

/*Remove space from the top of single children*/
.tree li:only-child {
    padding-top: 0;
}

/*Remove left connector from first child and 
right connector from last child*/
.tree li:first-child::before, .tree li:last-child::after {
    border: 0 none;
}
/*Adding back the vertical connector to the last nodes*/
.tree li:last-child::before {
    border-right: 1px solid #ccc;
    border-radius: 0 5px 0 0;
    -webkit-border-radius: 0 5px 0 0;
    -moz-border-radius: 0 5px 0 0;
}

.tree li:first-child::after {
    border-radius: 5px 0 0 0;
    -webkit-border-radius: 5px 0 0 0;
    -moz-border-radius: 5px 0 0 0;
}

/*Time to add downward connectors from parents*/
.tree ul ul::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    border-left: 1px solid #ccc;
    width: 0;
    height: 20px;
}

.tree li .parent {
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
    -moz-transition: all 0.5s;
    margin-top: 10px;
}
.tree li .parent::before {
    content: '';
    position: absolute;
    top: 40px;
    left: 50%;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    width: 3px;
    height: 10px;
}
.tree li .family {
    position: relative;
}
.tree li .family .spouse {
    position: absolute;
    top: 0;
    left: 50%;
    margin-left: 95px;
}
.tree li .family .spouse::before {
    content: '';
    position: absolute;
    top: 50%;
    left: -10px;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    width: 10px;
    height: 3px;
}

/*Time for some hover effects*/
/*We will apply the hover effect the the lineage of the element also*/
.tree li .child:hover,
.tree li .child:hover+.parent .person,
.tree li .parent .person:hover,
.tree li .child:hover+.parent .person+ul li .child,
.tree li .parent .person:hover+ul li .child,
.tree li .child:hover+.parent .person+ul li .parent .person,
.tree li .parent .person:hover+ul li .parent .person {
    background: #c8e4f8;
    color: #000;
    border: 2px solid #94a0b4;
}
/*Connector styles on hover*/
.tree li .child:hover+.parent::before,
.tree li .child:hover+.parent .person+ul li::after,
.tree li .parent .person:hover+ul li::after,
.tree li .child:hover+.parent .person+ul li::before,
.tree li .parent .person:hover+ul li::before,
.tree li .child:hover+.parent .person+ul::before,
.tree li .parent .person:hover+ul::before,
.tree li .child:hover+.parent .person+ul ul::before,
.tree li .parent .person:hover+ul ul::before {
    border-color: #94a0b4;
}

/*
.plus{
   color: white;
    background: #1260CC;
    padding: 1px;
    width:20%;
    height: 50%;
    cursor: pointer;    ;
    position: absolute;
    bottom: 9px;
    left: 0px;
}*/
</style>
@endpush
@push('style')
<style type="text/css">
    .zoom-header {
  display: flex;
}

.zoomin {
  position: relative;
  z-index: 1000;
}
.main-container {
  width: 100%;
  height: 80vh; 
  overflow:scroll;
}
.zoomout {
  position: relative;
  z-index: 1000;
}

.maindiv {/*
    width: 150%;*/ 
  transform-origin:0% 0%;
}
</style>
@endpush

@push('js')
<script type="text/javascript">
    let zoomArr = [0.5,0.75,0.85,0.9,1,1.2,1.5,1.7,1.9,2];


        var element = document.querySelector('.maindiv');
        let value = element.getBoundingClientRect().width / element.offsetWidth;

        let indexofArr = 4;
        handleChange = ()=>{
          let val = document.querySelector('#sel').value; 
          val = Number(val)
          console.log('handle change selected value ',val);
          indexofArr = zoomArr.indexOf(val);
         console.log('Handle changes',indexofArr)
          element.style['transform'] = `scale(${val})`
        }



        document.querySelector('.zoomin').addEventListener('click',()=>{
          console.log('value of index zoomin is',indexofArr)
          if(indexofArr < zoomArr.length-1){
            indexofArr += 1;
            value = zoomArr[indexofArr];
            document.querySelector('#sel').value = value
            // console.log('current value is',value)
            // console.log('scale value is',value)
            element.style['transform'] = `scale(${value})`
          }
        })

        document.querySelector('.zoomout').addEventListener('click',()=>{
         console.log('value of index  zoom out is',indexofArr)
          if(indexofArr >0){
             indexofArr -= 1;
             value = zoomArr[indexofArr];
             document.querySelector('#sel').value = value
          // console.log('scale value is',value)
          element.style['transform'] = `scale(${value})`
          }
        })
</script>
@endpush
