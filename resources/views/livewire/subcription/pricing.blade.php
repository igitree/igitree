<!-- This snippet uses Font Awesome 5 Free as a dependency. You can download it at fontawesome.io! -->
<section class="pricing py-5">
  <div class="container">
    <div  class="row">
      <!-- Free Tier -->
      <form class="col-lg-12" wire:submit.prevent="order">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card mb-5 ">
                  <div class="card-body"> 
                    <table class="table">
                      <thead>
                        <tr>
                          <td>
                            <strong>Features</strong>
                          </td>
                          <td>
                            <h5 class="card-title text-muted text-uppercase text-center">Monthly</h5>
                            <h6 class="card-price text-center">Frw 654<span class="period">/month</span></h6>
                          </td>
                          <td>
                             <h5 class="card-title text-muted text-uppercase text-center">Quarterly</h5>
                            <h6 class="card-price text-center"> Frw 1,357<span class="period">/Quarterly</span></h6> 
                          </td>
                          <td>
                            <h5 class="card-title text-muted text-uppercase text-center">Semiannual</h5>
                            <h6 class="card-price text-center"> Frw 3,101<span class="period">/Semiannual</span></h6>
                         </td>
                         <td>
                            <h5 class="card-title text-muted text-uppercase text-center">Annual</h5>
                            <h6 class="card-price text-center">Frw 5,790<span class="period">/Annual</span></h6>
                        </td> 
                        </tr>
                        <tr>
                          <td>
                            <ul class="fa-ul">
                              <li>Unlimited messaging</li> 
                            </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                        </tr>
                        <tr> 
                          <td>
                            <ul class="fa-ul">
                             <li>Unlimited number of family members on tree</li>
                            </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <ul class="fa-ul">
                              <li>24 / 7 Assitant</li>   
                            </ul> 
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                          <td>
                            <ul class="fa-ul">
                             <li><span class="fa-li"><i class="fas fa-check"></i></span>
                             </li>
                           </ul>
                          </td>
                        </tr>
                      </thead>
                    </table> 
                </div> 
            </div>  
        </div> 
           <div class="col-lg-6">
            <div class="card">
              <div class="card-body ">  
                We hope plan to continue running {{config('app.name') }} for many years decades to come. And we need the support of our community to do so!<br>
                <h3 class="mt-3">Contribute to {{config('app.name')}} family👉 </h3>
              </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
              <div class="card-body ">   
              A contribution of any amount will upgrade you to ✨ Premium Status ✨
               <div class="row mt-2">
                  <div class="col-lg-12">
                      <select class="form-control" wire:model.defer="PaymentTime">
                          <option>Monthly</option>
                          <option>Quarterly</option>
                          <option>Semiannual</option>
                          <option>Annual</option>
                      </select> 
                  </div>
                  <div class="col-lg-12 mt-2">
                    <button type="submit" class="btn btn-default btn-sm">Send Payment</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </form> 
    </div>
  </div>
</section>

@push('style')
    <style type="text/css">
     
.pricing .card {
  border: none;
  border-radius: 1rem;
  transition: all 0.2s; 
}

.pricing hr {
  margin: 1.5rem 0;
}

.pricing .card-title {
  margin: 0.5rem 0; 
  letter-spacing: .1rem;
  font-weight: bold;
}

.pricing .card-price {
  font-size: rem;
  margin: 0;
}

.pricing .card-price .period {
  font-size: 0.8rem;
}

.pricing ul li {
  margin-bottom: 1rem;
}

.pricing .text-muted {
  opacity: 0.7;
}

/* Hover Effects on Card *//*
    box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.3);*/

@media (min-width: 992px) {
  .pricing .card:hover {
    margin-top: -.25rem;
    margin-bottom: .25rem;
  }

  .pricing .card:hover .btn {
    opacity: 1;
  }
}

    </style>
@endpush