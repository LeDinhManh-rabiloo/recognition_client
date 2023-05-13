<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckDay extends Model
{
    protected $table = 'check_days';
    protected $primaryKey = 'id';
    protected $fillable = ['masv', 'name', 'imageLink', 'classId', 'teacherId', 'check'];

    public function classe()
    {
        return $this->belongsTo(ClassCourse::class, 'classId', 'courseId');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'masv', 'masv');
    }
}
