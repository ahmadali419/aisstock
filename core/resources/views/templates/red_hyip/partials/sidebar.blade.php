@php
    $promotionCount = App\Models\PromotionTool::count();
@endphp

<div class="dashboard__left">
    <div class="sidebar-menu">
        <span class="sidebar-menu__close d-lg-none d-block"><i class="las la-times"></i></span>
        <div class="sidebar-logo">
            <a href="{{ route('home') }}" class="sidebar-logo__link"> <img src="{{ getImage('assets/images/logoIcon/logo_2.png') }}" alt=" @lang('Logo')"></a>
        </div>
        <div class="sidebar-user">
            <div class="sidebar-user__balance">
                <span class="sidebar-user__balance-icon"><i class="las la-wallet"></i></span>
                <span class="sidebar-user__balance-text">@lang('Account Blance')</span>
            </div>
            <h5 class="sidebar-user__amount"> {{ showAmount(auth()->user()->deposit_wallet) }} <span class="sidebar-user__wallet"> (@lang('Deposit Wallet'))</span> </h5>
            <h5 class="sidebar-user__amount"> {{ showAmount(auth()->user()->interest_wallet) }} <span class="sidebar-user__wallet">(@lang('Interest Wallet'))</span> </h5>
        </div>

        <ul class="sidebar-menu-list">
            <li class="sidebar-menu-list__item {{ menuActive('user.home') }} ">
                <a href="{{ route('user.home') }}" class="sidebar-menu-list__link">
                    <span class="icon"><i class="fa fa-tachometer-alt"></i></span>
                    <span class="text">@lang('Dashboard')</span>
                </a>
            </li>
            <li class="sidebar-menu-list__item {{ menuActive('plan') }} ">
                <a href="#" class="sidebar-menu-list__link">
                    <span class="icon">
                        <i class="fas fa-cubes pr-1"></i>
                    </span>
                    <span class="text">@lang('Wallet')</span>
                </a>
            </li>
            @if ($general->schedule_invest)
                <li class="sidebar-menu-list__item {{ menuActive('user.invest.schedule') }} ">
                    <a href="#" class="sidebar-menu-list__link">
                        <span class="icon">
                            <i class="fas fa-calendar-check pr-1"></i>
                        </span>
                        <span class="text">@lang('Schedule Investment')</span>
                    </a>
                </li>
            @endif
            {{-- <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.deposit*', 3) }} ">
                <a href="javascript:void(0);" class="sidebar-menu-list__link ">
                    <span class="icon"><i class="fas fa-coins"></i></span>
                    <span class="text">@lang('Manage Deposits')</span>
                </a>
                <div class="sidebar-submenu {{ menuActive('user.deposit*', 2) }}">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.index') }}">
                            <a href="{{ route('user.deposit.index') }}" class="sidebar-submenu-list__link">@lang('Add Deposit')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.history') }}">
                            <a href="{{ route('user.deposit.history') }}" class="sidebar-submenu-list__link">@lang('Deposit history')</a>
                        </li>
                    </ul>
                </div>
            </li> --}}

            {{-- <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.withdraw*', 3) }}">
                <a href="javascript:void(0);" class="sidebar-menu-list__link">
                    <span class="icon"><i class="fas fa-wallet"></i></i></span>
                    <span class="text">@lang('Manage Withdraw')</span>
                </a>
                <div class="sidebar-submenu {{ menuActive('user.withdraw*', 2) }}">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{ menuActive('user.withdraw') }}">
                            <a href="{{ route('user.withdraw') }}" class="sidebar-submenu-list__link">
                                @lang('Withdraw')
                            </a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.withdraw.history') }}">
                            <a href="{{ route('user.withdraw.history') }}" class="sidebar-submenu-list__link">
                                @lang('Withdraw Log')
                            </a>
                        </li>

                    </ul>
                </div>
            </li> --}}
            @if ($general->b_transfer)
                <li class="sidebar-menu-list__item {{ menuActive('user.transfer.balance') }}">
                    <a href="#" class="sidebar-menu-list__link">
                        <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                        <span class="text">@lang('Transfer Balance')</span>
                    </a>
                </li>
            @endif

            
            <li class="sidebar-menu-list__item {{ menuActive('user.transactions') }}">
                <a href="#" class="sidebar-menu-list__link">
                    <span class="icon"><i class="fas fa-exchange-alt pr-1"></i></span>
                    <span class="text">@lang('Transaction')</span>
                </a>
            </li>

            <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.deposit*', 3) }} ">
                <a href="javascript:void(0);" class="sidebar-menu-list__link ">
                    <span class="icon"><i class="icon-md far fa-list-alt"></i></span>
                    <span class="text">@lang('Staking')</span>
                </a>
                <div class="sidebar-submenu {{ menuActive('user.deposit*', 2) }}">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.index') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Staking')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.history') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Compound Staking')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.history') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Stock Card')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.history') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Stock To Stock')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.history') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Transfer')</a>
                        </li>
                    </ul>
                </div>
            </li>
            
            {{-- @if ($general->promotional_tool && $promotionCount)
                <li class="sidebar-menu-list__item  {{ menuActive('user.promotional.banner') }}">
                    <a href="{{ route('user.promotional.banner') }}" class=" sidebar-menu-list__link">
                        <span class="icon"><i class="fas fa-ad "></i></span>
                        <span class="text">@lang('Activation')</span>
                    </a>
                </li>
            @endif --}}
            <li class="sidebar-menu-list__item {{ menuActive('ticket*') }}">
                <a href="#" class="sidebar-menu-list__link">
                    <span class="icon"><i class="fas fa-ticket-alt"></i></span>
                    <span class="text">@lang('Daily Earning')</span>
                </a>
            </li>


            
            <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.deposit*', 3) }} ">
                <a href="javascript:void(0);" class="sidebar-menu-list__link ">
                    <span class="icon"><i class="icon-md far fa-money-bill-alt"></i></span>
                    <span class="text">@lang('Team Building')</span>
                </a>
                <div class="sidebar-submenu {{ menuActive('user.deposit*', 2) }}">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.index') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Magic Box')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.history') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Team Building Earning')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.history') }}">
                        <a href="#" class="sidebar-submenu-list__link">@lang('Team Building Members')</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="sidebar-menu-list__item has-dropdown {{ menuActive('user.deposit*', 3) }} ">
                <a href="javascript:void(0);" class="sidebar-menu-list__link ">
                    <span class="icon"><i class="icon-md fas fa-award"></i></span>
                    <span class="text">@lang('Awards')</span>
                </a>
                <div class="sidebar-submenu {{ menuActive('user.deposit*', 2) }}">
                    <ul class="sidebar-submenu-list">
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.index') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Awards Achieved')</a>
                        </li>
                        <li class="sidebar-submenu-list__item {{ menuActive('user.deposit.history') }}">
                            <a href="#" class="sidebar-submenu-list__link">@lang('Rank Awards')</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- @if ($general->user_ranking) --}}
                {{-- <li class="sidebar-menu-list__item {{ menuActive('user.invest.ranking') }}">
                    <a href="{{ route('user.invest.ranking') }}" class="sidebar-menu-list__link">
                        <span class="icon"><i class="fas fa-chart-bar"></i></span>
                        <span class="text">@lang('Awards')</span>
                    </a>
                </li> --}}
            {{-- @endif --}}

            <li class="sidebar-menu-list__item ">
                <a href="{{ route('user.logout') }}" class="sidebar-menu-list__link">
                    <span class="icon"><i class="fas fa-sign-out-alt"></i> </span>
                    <span class="text">@lang('Logout')</span>
                </a>
            </li>

        </ul>
    </div>
</div>
