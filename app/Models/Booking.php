<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'booking_cabin';

    protected $primaryKey = 'id';
    protected $fillable = [
        'cabin_id',
        'time_id',
        'date_booking',
        'name_booking',
        'email_booking',
        'telephone_booking',
        'is_admin',
        'admin_id',
        'notes_booking',
        'user_delete_id',
        'date_deleted',
        'status', // 1: Chưa duyệt / 2: Đã duyệt
    ];
}
