    <div class="container">  
        <div class="checkout-section">
            <div class="row mt-5 justify-content-center">
                <form  class="row justify-content-center" wire:submit.prevent="order">
                    <div   class="col-lg-5 bg-white  p-3 shadow-sm mr-3">
                        @csrf  
                        <h4>Billing Details</h4>
                        <hr> 
                        @csrf
                        <div class="form-group">
                            <label for="email">Email Address</label> 
                            <input type="email" class="form-control" required id="email" wire:model.defer="o_email">
                           
                        </div>

                        <div class="form-group">
                            <label for="name">Full Name</label> 
                                <input type="text" class="form-control" required id="name" wire:model.defer="o_fullname" value="{{ auth()->user()->u_fullname }}" >
                           
                          
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <div class="search-panel">
                              <div class="search-panel__filters">
                                <div id="clear"></div>
                              </div>
                              <div class="search-panel__results">
                                <input id="searchbox" wire:model.defer="o_address"  value="{{ old('o_address') }}"/>
                                {{-- <div id="maps"></div> --}}
                              </div>
                            </div> 
                        </div> 
                        <div class="spacer"></div> 
                    </div>
                     <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-12 bg-white shadow-sm  p-3">
                                 <h4>Order Details</h4>
                                <hr>
                                <label class="p-2 alert-info">You will be charged {{number_format(100000)}} RWF</label> 
                                <div class="form-group">
                                    <label for="address">phone</label>
                                    <input type="text" class="form-control" required id="phone" wire:model.defer="o_phoneline" value="{{ old('o_phoneline') }}" >
                                </div>
                                <div class="form-group">
                                    <label for="address">Notes</label>
                                    <textarea id="note" class="form-control" wire:model.defer="o_notes"></textarea>
                                </div>  
                                <button  class="btn btn-sm btn-default" type="submit" name="pay">Pay Now</button>
                            </div>
                        </div> 
                    </div>                    
                </form> 
            </div> 
            <div class="row justify-content-center"> 
                <table class="col-lg-11 table widget-26 bg-white mt-4 shadow-sm">
                    <thead>
                        <tr>
                            <th colspan="8">Recent orders</th>
                          </tr>
                          <tr>
                              <th></th>
                              <th>Order id</th>
                              <th>fullname</th>
                              <th>Address</th>
                              <th>phoneline</th>
                              <th>email</th>
                              <th>notes</th>
                              <th>status</th>
                              <th>amount</th>
                              <th> date</th>
                          </tr>
                    </thead>
                    
                  <tbody> 
                    @forelse($orders as $order)

                        <tr>
                          <td>
                              <div class="widget-26-job-emp-img">
                                <strong>#</strong>
                              </div>
                          </td>
                          <td>
                              <div class="widget-26-job-title">
                                  {{ $order->o_uid}} 
                              </div>
                          </td>
                          <td>
                              <div class="widget-26-job-title">
                                  {{ $order->o_fullname}} 
                              </div>
                          </td>
                          <td>
                              <div class="widget-26-job-title">
                                  {{ $order->o_address}} 
                              </div>
                          </td>
                          <td>
                              <div class="widget-26-job-title">
                                  {{ $order->o_phoneline}} 
                              </div>
                          </td>
                          <td>
                              <div class="widget-26-job-title">
                                  {{ $order->o_email}} 
                              </div>
                          </td>
                          <td>
                              <div class="widget-26-job-title">
                                  {{ $order->o_notes}} 
                              </div>
                          </td>
                          <td>
                              <div class="widget-26-job-title pl-2 alert-{{ ($order->o_status ==2 ? 'success':'danger')}} ">
                                  {{ ($order->o_status ==2 ? 'Paid':'Failed')}} 
                              </div>
                          </td>
                           <td>
                              <div class="widget-26-job-title">
                                  {{ $order->o_amount}} 
                              </div>
                          </td>
                           <td>
                              <div class="widget-26-job-title">
                                  {{ $order->created_at}} 
                              </div>
                          </td> 
                      </tr>
                      @empty
                      @endforelse
                  </tbody>
                </table> 
            </div>
        </div> <!-- end checkout-section -->
    </div>   
    @push('style')
        <style type="text/css">
              em {
              background: cyan;
              font-style: normal;
            }

            h1 {
              margin-bottom: 1rem;
            }

            .container {
              max-width: 1200px;
              margin: 0 auto;
              padding: 1rem;
            }

            .search-panel {
              display: flex;
            }

            .search-panel__results {
              flex: 1;
            }

            #maps {
              margin-top: 1rem;
              height: 500px;
            }

        </style>
    @endpush