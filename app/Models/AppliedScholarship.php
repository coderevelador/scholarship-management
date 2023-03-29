<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedScholarship extends Model
{
    use HasFactory;

    protected $fillable = ['status'];

    public function studentDetails()
    {

        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function studentEducationDetails()
    {
        return $this->belongsTo(StudentEducationalDetails::class, 'student_id', 'student_id');
    }

    public function scholarshipName()
    {
        return $this->belongsTo(ScholarshipList::class, 'scholarship_id', 'id');
    }
    public function year()
    {
        $scholarshipYear = $this->scholarshipName()->with('yearname');
        
        return $scholarshipYear;
    }

    public function department()
    {
        $scholarshipDepartment = $this->scholarshipName()->with('department');
        
        return $scholarshipDepartment;
    }

    public function course()
    {
        $scholarshipCourse = $this->scholarshipName()->with('course');
        
        return $scholarshipCourse;
    }

    public function division()
    {
        $scholarshipDivision = $this->scholarshipName()->with('division');
        
        return $scholarshipDivision;
    }
}
