@extends($activeTemplate . 'layouts.master')
@section('content')
    <section>
        <div class="row justify-content-center">
            <div class="col-md-12">
                @php
                    // Get the timestamp when the key was generated
                    $keyGeneratedTime = strtotime($user->created_at);
            
                    // Calculate the expiration time (24 hours from the key generation time)
                    $expirationTime = $keyGeneratedTime + (24 * 60 * 60);
            
                    // Get the current timestamp
                    $currentTime = time();
            
                    // Check if the current time is greater than the expiration time
                    $keyExpired = $currentTime > $expirationTime;
                @endphp
            
                @if ($keyExpired)
                    <div class="alert border border--danger" role="alert">
                        <div class="alert__icon d-flex align-items-center text--danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">Your one-time generated key has been expired.</span><br>
                        </p>
                    </div>
                @else
                    <div class="alert border border--info" role="alert">
                        <div class="alert__icon d-flex align-items-center text--info">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">This is your one-time generated key which will expire in 24 hours.</span><br>
                            <small>
                                <i>Please save this key; it will be hidden after 24 hours.
                                <b style="color: red">{{ $user->on_time_key }}</b>
                                </i>
                            </small>
                        </p>
                    </div>
                @endif
            
                @if ($user->deposit_wallet <= 0 && $user->interest_wallet <= 0)
                    <div class="alert border border--danger" role="alert">
                        <div class="alert__icon d-flex align-items-center text--danger">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('Empty Balance')</span><br>
                            <small>
                                <i>@lang('Your balance is empty. Please make')
                                    <a href="#" class="text--base">
                                        @lang('deposit')
                                    </a>
                                    @lang('for your next investment.')
                                </i>
                            </small>
                        </p>
                    </div>
                @endif
    
                @if ($user->deposits->where('status', 1)->count() == 1 && !$user->invests->count())
                    <div class="alert border border--success" role="alert">
                        <div class="alert__icon d-flex align-items-center text--success">
                            <i class="fas fa-check"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('First Deposit')</span><br>
                            <small>
                                <i>
                                    <span class="fw-bold">@lang('Congratulations!')</span>
                                    @lang('You\'ve made your first deposit successfully. Go to')
                                    <a href="{{ route('plan') }}" class="text--base">
                                        @lang('investment plan')
                                    </a>
                                    @lang('page and invest now')
                                </i>
                            </small>
                        </p>
                    </div>
                @endif
    
                @if ($pendingWithdrawals)
                    <div class="alert border border--primary" role="alert">
                        <div class="alert__icon d-flex align-items-center text--primary"><i class="fas fa-spinner"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('Withdrawal Pending')</span><br>
                            <small><i>@lang('Total') {{ showAmount($pendingWithdrawals) }} 
                                    @lang('withdrawal request is pending. Please wait for admin approval. The amount will send to the account which you\'ve provided. See') <a href="{{ route('user.withdraw.history') }}"
                                        class="text--base">@lang('withdrawal history')</a></i></small>
                        </p>
                    </div>
                @endif
    
                @if ($pendingDeposits)
                    <div class="alert border border--primary" role="alert">
                        <div class="alert__icon d-flex align-items-center text--primary"><i class="fas fa-spinner"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('Deposit Pending')</span><br>
                            <small><i>@lang('Total') {{ showAmount($pendingDeposits) }} 
                                    @lang('deposit request is pending. Please wait for admin approval. See') <a href="{{ route('user.deposit.history') }}"
                                        class="text--base">@lang('deposit history')</a></i></small>
                        </p>
                    </div>
                @endif
                <div class="form-group mb-4">
                    <label>@lang('Referral Link') <span>★</span></label>
                    <div class="input-group">
                        <input type="text" name="text" class="form-control form--control referralURL" value="{{ route('home') }}?reference={{ auth()->user()->username }}" readonly="">
                        <button class="input-group-text copytext copyBoard" id="copyBoard" style=" background: linear-gradient(
                            180deg,
                            hsl(var(--base)) 5.48%,
                            hsl(var(--accent)) 59.04%,
                            hsl(var(--base)) 107.63%
                          );"> <i class="fa fa-copy"></i> </button>
                    </div>
                </div>
    
                {{-- @if (!$user->ts)
                    <div class="alert border border--warning" role="alert">
                        <div class="alert__icon d-flex align-items-center text--warning">
                            <i class="fas fa-user-lock"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('2FA Authentication')</span><br>
                            <small><i>@lang('To keep safe your account, Please enable') <a href="{{ route('user.twofactor') }}"
                                        class="text--base">@lang('2FA')</a> @lang('security').</i>
                                @lang('It will make secure your account and balance.')</small>
                        </p>
                    </div>
                @endif --}}
    
                @if ($isHoliday)
                    <div class="alert border border--info" role="alert">
                        <div class="alert__icon d-flex align-items-center text--info">
                            <i class="fas fa-toggle-off"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('Holiday')</span><br>
                            <small><i>@lang('Today is holiday on this system. You\'ll not get any interest today from this system. Also you\'re unable to make withdrawal request today.') <br> @lang('The next working day is coming after') <span id="counter"
                                        class="fw-bold text--primary fs--15px"></span></i></small>
                        </p>
                    </div>
                @endif
    
                @if ($user->kv == 0)
                    <div class="alert border border--info" role="alert">
                        <div class="alert__icon d-flex align-items-center text--info"><i class="fas fa-file-signature"></i>
                        </div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('KYC Verification Required')</span><br>
                            <small><i>@lang('Please submit the required KYC information to verify yourself. Otherwise, you couldn\'t make any withdrawal requests to the system.') <a href="{{ route('user.kyc.form') }}"
                                        class="text--base">@lang('Click here')</a> @lang('to submit KYC information').</i></small>
                        </p>
                    </div>
                @elseif($user->kv == 2)
                    <div class="alert border border--warning" role="alert">
                        <div class="alert__icon d-flex align-items-center text--warning"><i class="fas fa-user-check"></i></div>
                        <p class="alert__message">
                            <span class="fw-bold">@lang('KYC Verification Pending')</span><br>
                            <small><i>@lang('Your submitted KYC information is pending for admin approval. Please wait till that.') <a href="{{ route('user.kyc.data') }}"
                                        class="text--base">@lang('Click here')</a> @lang('to see your submitted information')</i></small>
                        </p>
                    </div>
                @endif
            </div>
        </div>
        <div class="row gy-4">
            <div class="col-xxl-4 col-sm-4">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="las la-dollar-sign"></i>
                            </div>
                            <p>@lang('Promotion Box
                                ')</p>
                            <h4>{{ showAmount($user->deposit_wallet) }} </h4>
                        </div>
                        <div class="card-item-body-right">
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-4">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-coins"></i>
                            </div>
                            <p>@lang('Total Balance Withdraw
    
    
                                ')</p>
                            <h4>{{ showAmount($user->interest_wallet) }} </h4>
                        </div>
                        <div class="card-item-body-right">
                          
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-4">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-chart-area"></i>
                            </div>
                            <p>@lang('Compound Staking
                                ') </p>
                            <h4>{{ showAmount($totalInvest) }} </h4>
                        </div>
                        <div class="card-item-body-right">
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-file-invoice-dollar"></i>
                            </div>
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
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="las la-cloud-download-alt"></i>
                            </div>
                            <p>@lang('Claim Box
    
    
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
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('Current Price
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('Earning Statistics 3X
    
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('ON Staking
    
    
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('ON Staking In Progress
    
    
    
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('Team Building Bonus
    
    
    
    
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('Team Building Bonus Withdraw
    
    
    
    
    
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('Direct Team Members')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('Daily Earning Balance
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('Daily Earning Withdraw
    
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 col-sm-3">
                <div class="dashboard-card">
                    <div class="dashboard-card__content">
                        <div class="">
                            <div class="dashboard-card__icon mb-3">


                                <i class="fas fa-wallet"></i>
                            </div>
                            <p>@lang('Latest Earning
    
    
                                ')</p>
                            <h4>{{ showAmount($referral_earnings) }} </h4>
                        </div>
                        
                    </div>
                </div>
            </div>
    
        </div>
      

        <div class="dashboard-table mt-5">
            <h4 class="dashboard-table-title mb-30">@lang('My Transaction')</h4>
            <table class="table table--responsive--xl">
                <thead>
                    <tr>
                        <th>@lang('Date')</th>
                        <th>@lang('Transaction ID')</th>
                        <th>@lang('Amount')</th>
                        <th>@lang('Wallet')</th>
                        <th>@lang('Details')</th>
                        <th>@lang('Post Balance')</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $trx)
                        <tr>
                            <td>
                                {{ showDatetime($trx->created_at, 'd/m/Y') }}
                            </td>
                            <td><span class="text-primary trx">{{ $trx->trx }}</span></td>

                            <td>
                                @if ($trx->trx_type == '+')
                                    <span class="text-success">+
                                        {{ $general->cur_sym }}{{ showAmount($trx->amount) }}</span>
                                @else
                                    <span class="text-danger">-
                                        {{ $general->cur_sym }}{{ showAmount($trx->amount) }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($trx->wallet_type == 'deposit_wallet')
                                    <span class="badge badge--info">@lang('Deposit Wallet')</span>
                                @else
                                    <span class="badge badge--primary">@lang('Interest Wallet')</span>
                                @endif
                            </td>
                            <td>{{ $trx->details }}</td>
                            <td><span>
                                    {{ $general->cur_sym }}{{ showAmount($trx->post_balance) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="text-center">
                                @lang('No Transaction Found')
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection


@push('style')
<style>
@media (max-width: 320.98px) {
    .trx {
        font-size: 11px;
    }
}
</style>
@endpush
