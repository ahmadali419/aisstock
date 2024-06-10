<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Lib\FormProcessor;
use App\Lib\GoogleAuthenticator;
use App\Lib\HyipLab;
use App\Models\Deposit;
use App\Models\Form;
use App\Models\Invest;
use App\Models\LotteryBalance;
use App\Models\PromotionTool;
use App\Models\Referral;
use App\Models\SupportTicket;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Withdrawal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{

    public function packages(){
        $data['pageTitle']         = 'Wallet';
        $user                      = auth()->user();
        $data['user']              = $user;
        return view($this->activeTemplate . 'user.packages',$data);
    }
    public function accountActivation(Request $request){
        $user = Auth::user();
        $user_id = Auth::user()->id;
        $transaction_amount = Transaction::where(['user_id'=>$user_id])->sum('amount');
        if($transaction_amount < 20){
            $notify[] = ['error', 'You dont have enough amount!'];
            return to_route('user.packages')->withNotify($notify);
        }
     

        //mange lottery balance
        $lottaryBalance = ['user_id'=>$user_id,'amount'=>10];
        LotteryBalance::create($lottaryBalance);
        //
        if($user->ref_by){
           self::directBonus($user);
        }

           //activate account
        $user = User::find($user_id);
        $user->account_activated = 1;
        $user->activation_date = Carbon::now()->format('Y-m-d');
        $user->deposit_wallet -= 20;
        $user->save();

        $notify[] = ['success', 'Your account has bees sucessfully activated'];
        return to_route('user.home')->withNotify($notify);

    }

    public function directBonus($user){
        $userWallet = User::find($user->ref_by);
        $userWallet->deposit_wallet += 10;
        $userWallet->save();
        Transaction::create([
            'user_id'=>$user->ref_by,
            'invest_id'=>$user->id,
            'amount'=>10,
            'charge'=>0,
            'post_balance'=>$userWallet->deposit_wallet,
            'details'=>'You have got direct bonus',
            'wallet_type'=>'direct_bonus'
           ]);
    }

}