<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeBooks extends Model
{
    use HasFactory;
    protected $table = 'timebooks';
    protected $primaryKey = 'time_id';
    protected $fillable = [
        'time_id','time_value'
    ];
}
