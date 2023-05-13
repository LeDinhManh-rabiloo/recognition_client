<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $fillable = ['userId', 'name', 'magv'];

    public function user()
    {
        return $this->belongsTo(User::class, "userId", "id");
    }
}
