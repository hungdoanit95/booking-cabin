<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    use HasFactory;
    protected $table = 'tuitions';
    protected $primaryKey = 'id';
    protected $fillable = [
        'certificate_id','tuition_total','tuition_paid','tuition_unpaid','student_id'
    ];
}
