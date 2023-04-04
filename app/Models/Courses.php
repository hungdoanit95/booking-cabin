<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $primaryKey = 'id';
    protected $fillable = [
        'student_id',
        'time_practice',
        'address_practice',
        'total_time',
        'time_practiced',
        'time_unpracticed',
    ];
}
