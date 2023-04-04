<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoneyCabin extends Model
{
    use HasFactory;
    protected $table = '';
    protected $primaryKey = '';
    protected $fillable = [
       'student_id',
       'date_payout',
       'cabin_money',
    ];
}
