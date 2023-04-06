<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlacklistPhone extends Model
{
    use HasFactory;
    protected $table = 'blacklist_phone';
    protected $primaryKey = 'id';
    protected $fillable = [
        'telephone',
        'status'
    ];
    public $timestamps = true;
}
