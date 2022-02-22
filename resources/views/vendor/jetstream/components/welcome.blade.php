
<div class="text-center">
   <div class="card-body">
       <div class="text-2xl">  
        Hi {{ auth()->user()->u_fullname }}, let’s setup your account real quick 
    </div> 
    <div class="text-gray-500 mt-3">
     Inorder to use all feature of {{ config('app.name') }} Please complete the verification steps to unlock and enjoy the full benefits of your account.
        {{ config('app.name') }} application  provide connection from past to present<br>
        <a href="{{ route('profile.show') }}" class="mt-3 btn btn-default btn-sm">Complete profile </a> 
    </div> 
   </div>
     
</div> 








  
