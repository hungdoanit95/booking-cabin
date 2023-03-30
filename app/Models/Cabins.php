<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabins extends Model
{
    use HasFactory;
    protected $table = 'cabins';
    protected $fillable = [
        'id',
        'name'
    ];
    protected $primaryKey = 'id';
}
