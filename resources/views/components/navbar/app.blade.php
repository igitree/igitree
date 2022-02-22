@if(auth()->user())
@php
  $payment =\App\Models\Payments::where('p_receipt',auth()->user()->u_id)->get()->first();
  if(!empty($payment)){
    $now = \Carbon\Carbon::now();
  $created_at = \Carbon\Carbon::parse($payment->created_at); 
    $hours = $created_at->diffInHours($now);


 
      if ($payment->p_time == 'Monthly') {
         if ($hours > 720 && $hours <= 8766) {
             $paymentModel=1;

          }else{
               $paymentModel=2;

          }
      }elseif ($payment->p_time == 'Quarterly') {

         if ($hours > (8766/4)) {
            $paymentModel=1;
         }else{
           $paymentModel=2;
         }

      }elseif ($payment->p_time == 'Semiannual') {
         if ($hours > (8766/2)) {
            $paymentModel=1;
         }else{
           $paymentModel=2;
         }        
      }elseif ($payment->p_time == 'Annual') {
         if ($hours > 8766) {
            $paymentModel=1;
         }else{
           $paymentModel=2;
         } 
      }else{
            $paymentModel=0;
          } 
  }else{
    $paymentModel=0;
  }
@endphp
@if($paymentModel == 0)
  <!-- ======= Header ======= -->
  <div class="header p-2">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">  
    
        <a href="{{ route('pricing') }}" class="btn btn-default align-items-center justify-content-center align-self-center text-white">Became a premium member on {{ config('app.name') }}</a> 
    </div>
  </div><!-- End Header -->
  @elseif($paymentModel == 1)
  <!-- ======= Header ======= -->
  <div class="header p-2">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">  
    
        <a href="{{ route('pricing') }}" class="btn btn-default align-items-center justify-content-center align-self-center text-white">Your subscription have been expired  renew now</a> 
    </div>
  </div><!-- End Header -->
@endif
@endif