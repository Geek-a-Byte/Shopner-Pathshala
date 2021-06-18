<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

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

    public function childs()
    {
        return $this->belongsToMany(Child::class, 'child_course',  'child_id', 'course_code');
    }

}
