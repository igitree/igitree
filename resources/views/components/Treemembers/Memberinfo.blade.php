<!-- Modal -->
<div class="modal form_pop fade" id="exampleModalCenter"  style="display:none" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true"  wire:ignore.self>
  <div class="modal-dialog modal-dialog-centered border-0  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Personal Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"> 
          <div class="row">
            <div class="container"> 
              <div class="col-lg-12">
                 <div class="row">
                      <div class="col-lg-12"> 
                          <h2>Name</h2>
                          <p><strong>About: </strong> Web Designer / UI. </p>
                          <p><strong>Hobbies: </strong> Read, out with friends, listen to music, draw and learn new things. </p>     
                      </div> 
                      <div>
                        <form>
                          <input type="text" name="" wire:model.defer="state.u_fullname">
                          
                        </form>
                      </div>  
                 </div>                 
              </div>
            </div>
          </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@push('style')
  <style type="text/css">
    
  </style>
@endpush
