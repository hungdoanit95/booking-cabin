<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = [
        'time_hidden', // Cột A: Dấu thời gian
        'student_code', // Cột B: Mã HV
        'student_name', // Cột C: Họ và Tên học viên
        'course_code', // Cột D: Khóa
        'course_planed', // Cột E: Khoá dự kiến Dành cho CSKH
        'birthday', // Cột J Ngày sinh
        'address', // Cột k Địa chỉ
        'telephone', // Cột L Điện thoại
        'telephone2', // Cột M SDT khác
        'id_student', // Cột N Id student
        'exam_evenue', // Cột CK Địa điểm thi (máy đặt cabin). Một cabin sẽ đại diện cho 1 địa điểm và dựa vào địa điểm thi để cho học viên đăng ký sử dụng
        'exam_course', // Cột CL Khóa thi
        'date_give_card', //Ngày cấp thẻ học nghề (ĐỐI VỚI BĐXN)
    ];
}
