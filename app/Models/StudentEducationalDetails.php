<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEducationalDetails extends Model
{
    use HasFactory;

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, "year_id", "id");
    }

    public function departmentName()
    {
        return $this->belongsTo(Department::class, "department_id", "id");
    }

    public function course()
    {
        return $this->belongsTo(Course::class, "course_id", "id");
    }

    public function division()
    {
        return $this->belongsTo(division::class, "division_id", "id");
    }
}
