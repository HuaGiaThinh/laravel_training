<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    public $table = 'vouchers';
    protected $fillable = [
        'code', 'post_id', 'user_id',
    ];
}
