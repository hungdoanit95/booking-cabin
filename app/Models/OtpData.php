<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtpData extends Model
{
    use HasFactory;
    protected $table = 'otp_data';
    protected $primaryKey = 'id';
    protected $fillable = [
        'telephone',
        'otp_code',
        'date_add'
    ];
    public $timestamps = true;
}
