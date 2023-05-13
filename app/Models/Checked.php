<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checked extends Model
{
    protected $table = 'checkeds';
    protected $primaryKey = 'id';
    protected $fillable = ['studentId', 'courseId', 'days'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'studentId', 'id');
    }
}
