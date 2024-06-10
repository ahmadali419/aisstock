@extends($activeTemplate . 'layouts.master')
@section('content')
<section>

<div class="row justify-content-center">
    
    <div class="col-md-12">
        @if ($user->status == 2)
        <div class="alert border border--danger" role="alert">
            <div class="alert__icon d-flex align-items-center text--danger">
                <i class="fas fa-exclamation-triangle" style=" font-size: 31px;padding:10px"></i>
            </div>
            <p class="alert__message">
                <span class="fw-bold">@lang('Your Account Is Currently In-Active. Please Activate it.')</span><br>
                <small>
                    <i>
                        <a href="#" class="text--base">
                        </a>
                    </i>
                </small>
            </p>
        </div>
        @endif
        <div class="card custom--card">
                
            <div class="card-header ribbon ribbon-clip ribbon-right ">
                <div class="ribbon-target" style="top: 15px; height: 45px; width: 15%">
                    <span class="ribbon-inner " style="background-color: #28ca44ba !important;"></span>
                </div>
                <h3 class="card-title">Basic Account Activation Plan</h3>
            </div>
            <!--begin::Form-->
            <form method="post" action="{{ route('user.activatePackage') }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group">                                                   
                        <h2>JUST IN 20 <small class="text-uppercase">usdt</small></h2>
                    </div>
                    <div class="form-group ">
                        <label><i class="icon-md far fa-check-square text-success"></i> <strong class="mr-2"> Account Activation</strong></label><br>
                        <label><i class="icon-md far fa-check-square text-success"></i> <strong class="mr-2"> Staking Activation</strong></label><br>
                        <label><i class="icon-md far fa-check-square text-success"></i> <strong class="mr-2"> Unlimited Staking</strong></label><br>
                        <label><i class="icon-md far fa-check-square text-success"></i> <strong class="mr-2"> 3x Earning</strong></label><br>
                        <label><i class="icon-md far fa-check-square text-success"></i> <strong class="mr-2"> Daily Earning</strong></label><br>
                        <label><i class="icon-md far fa-check-square text-success"></i> <strong class="mr-2"> Team Building Activation</strong></label><br>
                        <label><i class="icon-md far fa-check-square text-success"></i> <strong class="mr-2"> Team Building Bonus</strong></label><br>
                        <label><i class="icon-md far fa-check-square text-success"></i> <strong class="mr-2"> Award Achivement Activation</strong></label><br>
                        <label><i class="fa fa-window-close text-danger" aria-hidden="true"></i> <strong class="mr-2"> Advance Trading Education</strong></label><br>
                        <label><i class="fa fa-window-close text-danger" aria-hidden="true"></i> <strong class="mr-2"> Advance E-Commerce Education</strong></label><br>
                        <label><i class="fa fa-window-close text-danger" aria-hidden="true"></i> <strong class="mr-2"> Internation Trading Expert Education</strong></label><br>
                        
                    </div>
                                        
                    <div class="">
                        <label>Payment Method</label>
                                                    <div class="radio-inline form-check ">
                            <label class="radio radio-rounded">
                            <input wire:ignore="" class="form-check-input" type="radio" checked="" name="paymentMethod" value="eyJpdiI6IkZKU0VmZEQyWnVNTW1Sd1lFUkV1QXc9PSIsInZhbHVlIjoiMWdJNUZaUUM1M2l2bEh1WXpjYW1rUT09IiwibWFjIjoiMGQyMzM2YzBkZTFlYzdiOWJmZjkzZWI2MDAyMmI5ZTU1NDJhYWJmMDdiMzU0YTdhNjY0YTUyOTdiMDRlNmU0MyIsInRhZyI6IiJ9" wire:click="$set('basicPaymentType','eyJpdiI6Im5wajByWlhXTzBGUENVUmN4Y0pFckE9PSIsInZhbHVlIjoiZHlLWCs1SzV3bDBLQXFocXM5Mmxudz09IiwibWFjIjoiMDBkMzg1YjhmZGJiMzJmY2M5Zjc2YjA0MmE1ZGQ1NDI1Y2MxMTA1YTZjMGQ0NTQ3NDI1ZDlhZDRjMjdkMTI1NCIsInRhZyI6IiJ9')">
                            <span></span>USDT</label>
                            
                           
                        </div>
                       
                    </div>
                    
                                            <div class="form-group">  
                        <h2>Converted USDT TO OMNI</h2>
                        <div class="row">                                                 
                            <div class="col-md-12 d-flex form-text text-muted">                                                 
                                <div class="col-md-8">                                                 
                            
                                    <p><b>OMNI Current Rate:</b></p>
                            
                                </div>
                                <div class="col-md-4 text-left">                                                 
                            
                                    <p class="text-success text--base" wire:poll.visible.5000ms=""> <strong>{{ gs("stock_current_rate") }} USDT</strong></p>
                            
                                </div>
                            </div>
                            <div class="col-md-12 d-flex form-text text-muted">                                                 
                                <div class="col-md-8">                                                 
                            
                                    <p><b>Plan Price :</b> </p>
                            
                                </div>
                                <div class="col-md-4 text-left">                                                 
                            
                                    <p class="text-success text--base"><strong>20 USDT</strong></p>
                            
                                </div>
                            </div>
                            <div class="col-md-12 d-flex form-text text-muted">                                                 
                                <div class="col-md-8">                                                 
                            
                                    <p><b>Conversion :</b> </p>
                            
                                </div>
                                <div class="col-md-4 text-left">                                                 
                            
                                    <p class="text-success text--base"><strong>{{ 20/gs('stock_current_rate') }} Aisstock</strong></p>
                            
                                </div>
                            </div>
                        </div>
                       
                    </div>
                                                                   
                </div>
                <div class="card-footer text-center">

                                     <button type="submit" class="btn btn-primary mr-2 btn--outline-base">Activate Now</button>
                                      
                   
                </div>
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
</section>
@endsection
@push('script')
<script>
    function copyToClipboard(elementId) {
        // Get the text from the element
        var textToCopy = document.getElementById(elementId).innerText;

        // Create a temporary textarea element to hold the text
        var tempTextArea = document.createElement('textarea');
        tempTextArea.value = textToCopy;

        // Append the textarea to the body
        document.body.appendChild(tempTextArea);

        // Select the text
        tempTextArea.select();

        // Copy the text
        document.execCommand('copy');

        // Remove the textarea from the DOM
        document.body.removeChild(tempTextArea);

        // Show an alert
        alert('Wallet address copied to clipboard!');
    }
</script>
@endpush
