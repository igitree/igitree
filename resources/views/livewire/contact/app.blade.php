  <div class="container mt-5"> 
    <div class="row gy-4"> 
      <div class="col-lg-6"> 
        <div class="row gy-4">
          <div class="col-md-6">
            <div class="info-box">
              <i class="bi bi-geo-alt"></i>
              <h3>Address</h3>
              <p>Remera corner</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-box">
              <i class="bi bi-telephone"></i>
              <h3>Call Us</h3>
              <p>+250 787961983<br></p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
                <div class="col-lg-12 p-3">
                     Connect with Your Social Accounts                     
                <div class="d-flex flex-row">
                    <div class="flex-fill p-2">
                        <a target="_blank" href="mailto:eexonmuhizi@gmail.com" class="btn btn-sm btn-block btn-google"  >  <i class="fa fa-google-plus" style="font-size:24px"></i> Gmail</a>
                    </div>
                    <div class="flex-fill p-2">
                         <a target="_blank" href="https://www.facebook.com/Igitree-106024527789958/" class="btn btn-sm btn-block btn-facebook "><i class="fa fa-facebook-square" style="font-size:24px"></i>  Facebook</a>
                    </div> 
                </div>
                <div class="d-flex flex-row">
                    <div class="flex-fill p-2">
                         <a  target="_blank" href="https://twitter.com/igiTree" class="btn btn-sm btn-block btn-twitter "><i class="fa fa-facebook-square" style="font-size:24px"></i>  Twitter</a>
                    </div>
                    <div class="flex-fill p-2">
                         <a target="_blank" href="https://www.instagram.com/igi_tree/" class="btn btn-sm btn-block btn-instagram "><i class="fa fa-facebook-square" style="font-size:24px"></i>  Instagram</a>
                    </div>  
                </div>  
              </div> 
            </div> 
          </div> 
        </div> 
      </div> 
      <div class="col-lg-6"> 
        <form   method="post" class="" wire:submit.prevent="contactUs">
          <div class="row gy-4"> 
            <div class="col-md-12"> 
            </div>
            <div class="col-md-6">
              <label>Your Name</label>
              <input type="text" wire:model.defer="state.m_name" class="form-control" placeholder="Your Name" required>
              
            </div>
            <div class="col-md-6 ">
              <label>Your Email</label>
              <input type="email" class="form-control" wire:model.defer="state.m_email" placeholder="Your Email" required>
               
            </div>

            <div class="col-md-12">
              <label>Subject</label> 
              <select wire:model.defer="state.m_subject" class="form-control" required>
                <option>Report Error </option>
                <option>Requesting service</option>
              </select>
            </div>

            <div class="col-md-12">
              <label>Message</label>
              <textarea class="form-control" wire:model.defer="state.m_message" rows="6" placeholder="Message" required></textarea> 
            </div> 
            <div class="col-md-12 text-center"> 
              <button type="submit" class="btn btn-block btn-default">Send Message</button>
            </div> 
          </div>
        </form> 
      </div> 
    </div> 
  </div>