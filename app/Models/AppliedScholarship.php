<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedScholarship extends Model
{
    use HasFactory;

    public function studentDetails()
    {

        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function studentEducationDetails()
    {
        return $this->belongsTo(StudentEducationalDetails::class, 'student_id', 'student_id');
    }

}
