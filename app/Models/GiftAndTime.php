<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftAndTime extends Model
{
    use HasFactory;
    protected $table = 'gift_and_time';
    protected $primaryKey = 'id';
    protected $fillable = [
        'books','gifts','tuition_solid','money_discount_fullmoney','money_discount_in','money_discount_ex','reg_group','total_tuition','compare'
    ];
}
