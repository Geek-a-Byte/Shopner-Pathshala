<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
<<<<<<< HEAD
=======

>>>>>>> c6555383b0d62b6274cb1ab0c3293b498f2afa2b
    protected $fillable = [
        'teacher_id',
        'course_code', 'course_level', 'course_duration', 'course_name', 'pre_requisite',
    ];
    public function user()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    protected $primaryKey = 'course_code';
    protected $table = 'courses';
<<<<<<< HEAD
=======

    public function childs()
    {
        return $this->belongsToMany(Child::class, 'child_course',  'child_id', 'course_code');
    }

>>>>>>> c6555383b0d62b6274cb1ab0c3293b498f2afa2b
}
