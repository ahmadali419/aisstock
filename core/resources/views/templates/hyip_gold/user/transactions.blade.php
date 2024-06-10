@extends($activeTemplate . 'layouts.master')
@section('content')
    <section class="pt-150 pb-150">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card custom--card">
                    <div class="card-header">
                        <h3 class="card-title">Deposit USDT</h3>
        
                    </div>
                    <!--begin::Form-->
                    <form id="busdDeposit" action="{{ route('user.deposit.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group mb-8">
                                <div class="alert alert-custom alert-default" role="alert">
                                    <div class="alert-icon">
                                        <span class="svg-icon svg-icon-primary svg-icon-xl">
                                            <!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Tools/Compass.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <div class="alert-text"><strong class="text-danger">Alert:</strong> Only deposit USDT
                                        allowed with binance. Before transaction please verify your deposit TXID and to address.
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12 col d-flex justify-content-center">
                                        <img class="h-120px" style="height: 120px" src="https://app.omnistock.io/uploads/binance/LtVuYoJN38O1kFeovFDEm2YS3n8rg2MaXXs19qwH.jpg" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Deposit To Address</label>
                                <input type="text" readonly="" class="form-control " wire:model="depositToAddress" value="{{ gs('deposit_address') }}" name="depositToAddress" placeholder="Deposit To Address" required="">
        
                                <span class="form-text text-muted">Copy and deposit on this address</span>
                                                    </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Deposit Allowed Network</label>
                                <input type="text" class="form-control " readonly="" name="depositNetwork" wire:model="depositNetwork" placeholder="TRC20" value="Tron (TRC20)" required="">
                                <span class="form-text text-muted">For deposit please use only binance</span>
                                                    </div>
                            <div class="form-group">
                                <label>Amount (USDT)</label>
                                <input type="number" min="10" max="10000000000" class="form-control " wire:model="amount" value="20" name="amount" step="any" placeholder="10" required="">
                                <span class="form-text text-muted">Minimum deposit is 20 USDT</span>
                                                    </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">TXID</label>
                                <input type="text" class="form-control " wire:model="txid" value="" name="txid" placeholder="TXID" required="">
                                <span class="form-text text-muted">Please Don't remove anything from TXID for example (Internal
                                    transfer 1649413168917)</span>
                                                    </div>
                            <div class="form-group" x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading  = true" x-on:livewire-upload-finish="isUploading = false; progress = 0" x-on:livewire-upload-error="isUploading  = false" x-on:livewire-upload-progress="progress  = $event.detail.progress">
                                <label class="form-label">Upload Deposited USDT Receipt</label>
                                <div class="text-left  mx-auto" x-data="{imagePreview: '' }">
                                    <input type="file" id="transaction-file" class="form-control" name="file" onchange="showPreview(event);"/>

                                    <img id="file-ip-1-preview" style="height: 100px" class="mt-3" src="{{ asset('assets/images/deposit.jpg') }}">
                                   
                                    <div class="progress col-sm-12 mt-2 pr-0 pl-0" x-show.transition="isUploading" style="display: none;">
        
                                        <div class="progress-bar progress-bar-striped bg-warning" role="progressbar" aria-valuenow="25" aria-valuemin="25" aria-valuemax="100" x-bind:style="`width:${progress}%`" style="width:0%"></div>
        
                                    </div>
                                                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ONE TIME KEY</label>
                                <input type="text" class="form-control " wire:model="oneTimeKey" value="" name="oneTimeKey" placeholder="One Time Key" required="">
                                <span class="form-text text-muted">Please put your one time system generated key.</span>
                                                                        </div>
        
        
                        <!--end: Code-->
                    </div>
                    <div class="card-footer">
                        <button wire:loading.attr="disabled" type="submit" class="btn btn-success mr-2 btn--outline-base">Deposit
                            Now</button>
        
                    </div>
                </form>
                <!--end::Form-->
            </div>
            </div>  
            <div class="col-md-6">
                <div class="card custom--card">
                    <div class="card-header">
                        <h3 class="card-title">Withdraw USDT</h3>
                        <div class="card-toolbar">
                            <div class="example-tools justify-content-center">
                                <span class="example-toggle" data-toggle="tooltip" title="View code"></span>
                                <span class="example-copy" data-toggle="tooltip" title="Copy code"></span>
                            </div>
                        </div>
                    </div>
                    <!--begin::Form-->
                    <form id="busdWithraw">
                        <div class="card-body">
                            <div class="form-group form-group-last">
                                <div class="alert alert-custom alert-default" role="alert">
                                    <div class="alert-icon">
                                        <span class="svg-icon svg-icon-primary svg-icon-xl">
                                            <!--begin::Svg Icon | path:/keen/theme/demo6/dist/assets/media/svg/icons/Tools/Compass.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                    <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                                                    <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </div>
                                    <div class="alert-text">
                                        <div class="alert-text"><strong class="text-danger">Alert:</strong> Only Withdraw
                                            allowed with binance. Before transaction please verify your withdraw address. <span class="text-warning">And 1 withdraw can apply in a day max withdraw limit is
                                                250 USDT</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Amount (AISSTOCK Shares)</label>
                                <input type="number" min="1" max="10000" class="form-control " wire:model.change="omniShares" value="" name="omniShares" step="any" placeholder="0.00" required="">
                                <span class="form-text text-warning">Minimum 15 USDT worth AISSTOCK shares you can withdraw.</span>
                                                </div>
                            <div class="form-group">
                                <label>Auto Converted To (USDT)</label>
                                <input type="number" min="15" max="10000" readonly="" class="form-control " wire:model="convertedBusd" value="" name="convertedBusd" step="any" placeholder="0.00" required="">
                                <span class="form-text text-muted">OMNI Shares Auto Converted to USDT</span>
                                                </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Withdraw To Address</label>
                                <input type="text" class="form-control " wire:model="withdrawAddress" name="withdrawAddress" placeholder="Withdraw To Address" required="">
            
                                <span class="form-text text-muted">Please put your binance withdraw address</span>
                                                </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Withdraw Allowed Network</label>
                                <input type="text" class="form-control " readonly="" name="withdrawNetwork" wire:model="withdrawNetwork" placeholder="TRC20" value="Tron (TRC20)" required="">
                                <span class="form-text text-muted">For withdraw please use only binance</span>
                                                </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">ONE TIME KEY</label>
                                <input type="text" class="form-control " wire:model="withdrawOneTimeKey" value="" name="withdrawOneTimeKey" placeholder="One Time Key" required="">
                                <span class="form-text text-muted">Please put your one time system generated key.</span>
                                                                </div>
                    </div>
                        </form>
                <!--end::Form-->
            </div>
            </div>
        </div> 
       
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="show-filter mb-3 text-end">
                    <button type="button" class="showFilterBtn btn-sm btn btn--outline-base btn-small">
                        <i class="las la-filter"></i>
                        @lang('Filter')
                    </button>
                </div>
                {{-- <div class="card custom--card responsive-filter-card mb-4">
                    <div class="card-body">
                        <form action="">
                            <div class="d-flex flex-wrap gap-4">
                                <div class="flex-grow-1 from-group">
                                    <label>@lang('Transaction Number')</label>
                                    <input type="text" name="search" value="{{ request()->search }}"
                                        class="form-control form--control">
                                </div>
                                <div class="flex-grow-1 form-group has-icon-select">
                                    <label>@lang('Wallet Type')</label>
                                    <select name="wallet_type" class="form--control form-select">
                                        <option value="">@lang('All')</option>
                                        <option value="deposit_wallet" @selected(request()->wallet_type == 'deposit_wallet')>@lang('Deposit Wallet')
                                        </option>
                                        <option value="interest_wallet" @selected(request()->wallet_type == 'interest_wallet')>@lang('Interest Wallet')
                                        </option>
                                    </select>
                                </div>
                                <div class=" flex-grow-1 form-group has-icon-select">
                                    <label>@lang('Type')</label>
                                    <select name="trx_type" class="form--control form-select">
                                        <option value="">@lang('All')</option>
                                        <option value="+" @selected(request()->trx_type == '+')>@lang('Plus')</option>
                                        <option value="-" @selected(request()->trx_type == '-')>@lang('Minus')</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1 form-group has-icon-select">
                                    <label>@lang('Remark')</label>
                                    <select class="form--control form-select" name="remark">
                                        <option value="">@lang('Any')</option>
                                        @foreach ($remarks as $remark)
                                            <option value="{{ $remark->remark }}" @selected(request()->remark == $remark->remark)>
                                                {{ __(keyToTitle($remark->remark)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex-grow-1 from-group align-self-end">
                                    <button class="btn btn--outline-base btn-small filter-btn w-100"><i class="las la-filter"></i>
                                        @lang('Filter')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
                <div class="dashboard-table">

                    <table class="table transection__table table--responsive--xl">
                        <thead>
                            <tr>
                                <th>@lang('TXID')</th>
                                <th>@lang('Transacted')</th>
                                <th>@lang('Amount')</th>
                                <th>@lang('Deposit Network')</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $trx)
                                <tr>
                                    <td>
                                        <strong>{{ $trx->trx }}</strong>
                                    </td>

                                    <td>
                                        {{ showDateTime($trx->created_at) }}<br>{{ diffForHumans($trx->created_at) }}
                                    </td>

                                    <td class="budget">
                                        <span
                                            class="fw-bold @if ($trx->trx_type == '+') text--success @else text--danger @endif">
                                            {{ $trx->trx_type }} {{ showAmount($trx->amount) }} {{ $general->cur_text }}
                                        </span>
                                    </td>

                                   <td>
                                    Tron (TRC20)
                                   </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-muted text-center" colspan="100%">{{ __($emptyMessage) }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($transactions->hasPages())
                    {{ $transactions->links() }}
                @endif
            </div>
        </div>

        </div>
    </section>
@endsection

@push('style')
    <style>
        .filter-btn{
            height: 60px;
        }
    </style>
@endpush

@push('script')
    <script>
          function showPreview(event){
            if(event.target.files.length > 0){
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
        (function($) {
            "use strict";
            $('.showFilterBtn').on('click', function() {
                $('.responsive-filter-card').slideToggle();
            });
        })(jQuery);
    </script>
@endpush
