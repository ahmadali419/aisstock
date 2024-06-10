<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LotteryBalance extends Model
{
    use HasFactory;
    protected $table = 'lottery_balance';
    protected $guarded = [];
}
