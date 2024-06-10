@extends($activeTemplate . 'layouts.master')
@section('content')
<section>

<div class="row justify-content-center">
    
    <div class="col-md-12">
        @if ($user->account_activated == 0)
        <div class="alert border border--danger" role="alert">
            <div class="alert__icon d-flex align-items-center text--danger">
                <i class="fas fa-exclamation-triangle" style=" font-size: 31px;padding:10px"></i>
            </div>
            <p class="alert__message">
                <span class="fw-bold">@lang('Your Account Is Currently In-Active. Please Activate it.')</span><br>
                <small>
                    <i>
                        <a href="{{ route('user.packages') }}" class="text--base">
                            @lang('Account Activation')
                        </a>
                    </i>
                </small>
            </p>
        </div>
        @endif
        <div class="alert border border--danger" role="alert">
            <div class="alert__icon d-flex align-items-center text--danger">
                <i class="fab fa-readme text-success font-size-h1" style="color: #f3ba2fad !important;    font-size: 31px;padding:10px"></i>
            </div>
            <p class="alert__message">
                <span class="fw-bold">@lang('Wallet Address:')</span><br>
                <small id="omniWalletAddressCopy">
                    {{ Auth::user()->wallet_address }}
                </small></br>
                <a href="javascript:void(0)" title="Copy OMNI Wallet Address" onclick="copyToClipboard('omniWalletAddressCopy')"><i class="las la-key text-success" style="font-size: large !important;color: #f3ba2fad !important;"></i> Copy Wallet Address</a>
            </p>
        </div>
    </div>
</div>

<div class="row gy-4 mt-4">
    
    
   
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <p>@lang('Wallet Balance

                        ') </p>
                    <h4>{{ showAmount($user->deposits->where('status', 1)->sum('amount')) }}
                        
                    </h4>
                </div>
                <div class="card-item-body-right">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3 ">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="las la-cloud-download-alt"></i>
                    <p>@lang('Current AISSTOCk Rate



                        ')</p>

                    <h4>{{ showAmount($user->withdrawals->where('status', 1)->sum('amount')) }}
                        </h4>
                </div>
                <div class="card-item-body-right">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('Earning Statistics

                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('Weekly Reward Bonus


                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('ON Staking


                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('ON Staking In Progress



                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('Team Building Bonus




                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('Team Building Bonus Withdraw





                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('Total Team Members
                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('Daily Earning Balance
                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('Daily Earning Withdraw


                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-sm-3">
        <div class="card-item">
            <div class="card-item-body d-flex justify-content-between">
                <div class="card-item-body-left">
                    <i class="fas fa-wallet"></i>
                    <p>@lang('Latest Earning


                        ')</p>
                    <h4>0.00 </h4>
                </div>
                <div class="card-item-body-right">
                   
                </div>
            </div>
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
