<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassCourse extends Model
{
    protected $table = 'class_courses';
    protected $primaryKey = 'id';
    protected $fillable = ['courseId', 'name', 'teacherId'];

    public function course()
    {
        return $this->belongsToMany(Student::class, 'checkeds', 'courseId', 'studentId');
    }

    public function checkDay()
    {
        return $this->hasMany(CheckDay::class, 'classId', 'courseId');
    }
}
