<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = ['masv', 'name', 'className'];

    public function course()
    {
        return $this->belongsToMany(ClassCourse::class, 'checkeds', 'studentId', 'courseId');
    }

    public function checkDay()
    {
        return $this->hasMany(CheckDay::class, 'masv', 'masv');
    }

    public function checked()
    {
        return $this->hasMany(Checked::class, 'studentId', 'id');
    }
}
