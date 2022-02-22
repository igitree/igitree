<x-app-layout>
    {{--
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(empty(auth()->user()->u_dob) or empty(auth()->user()->u_address) or  empty(auth()->user()->u_phoneline) )
        
            <div class="">
                <x-jet-welcome>
                </x-jet-welcome>
            </div>
            @else
            <div class=" text-2xl text-center ">
                <h2>
                    Hi {{ auth()->user()->u_fullname }}, Welcome back
                </h2>
            </div>
            <div class="text-center mt-3 mb-5">
                <a class="btn btn-default btn-sm mt-3" href="{{ route('tree') }}">
                    {{ auth()->user()->u_fullname }} continue building tree family
                </a>
                <a class="btn btn-default btn-sm mt-3" href="{{ route('search') }}">
                   Quickly find your ancestory
                </a>
            </div>
            @endif
            <div class="row justify-content-center">
                @php
                    $checkuserFamily=DB::table('tbl_family')->where('f_id',auth()->user()->u_id)->get()->first();
                    if ($checkuserFamily) {
                       
                     } 
                  @endphp
                  @if($checkuserFamily==null)
                  @endif
                <div class="col-lg-12 mt-3">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card rounded shadow-sm border-0">
                                <div class="p-3">
                                    <h5 class="card-title">
                                        Build Your Tree with Ease
                                    </h5>
                                    <p class="card-body text-muted">
                                        When you connect to the {{ config('app.name') }} shared tree, some of your ancestors may have an abundance of information already in their profile. {{ config('app.name') }} can also show you possible records for that ancestor.
                                    </p>
                                    <a class="btn btn-default btn-sm" href="{{ route('tree') }}">
                                        Start for free
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <div class="card rounded shadow-sm border-0">
                                <div class="p-3">
                                    <h5 class="card-title">
                                        {{ auth()->user()->fullname }} Chat with Others from family
                                    </h5>
                                    <p class="card-body text-muted">
                                        FamilySearch Family Tree enables all descendants to share information that others might not know and add sources to confirm correct information. The overall result of a well-sourced shared tree can be much more complete and accurate than individual trees.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card rounded shadow-sm border-0">
                                <div class="p-3">
                                    <h5 class="card-title">
                                        {{ auth()->user()->fullname }} Why Use the {{ config('app.name') }} Shared Tree?
                                    </h5>
                                    <p class="card-body text-muted">
                                        The FamilySearch Family Tree can help you more easily connect to your family and build your family history. Here are a few ways it might help you.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mt-5">
                    <div class=" text-2xl text-center ">
                        <h2>
                            Premium membership
                        </h2>
                    </div>
                    <div class="text-center">
                        <p class="text-muted">
                            Enjoying Ancestry®? Subscribe to access our full collection of records.
                        </p>
                        <a class="btn btn-default btn-sm" href="{{route('pricing')}}">
                            Become premium member
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
