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

    public function eligibilityAmount()
    {
        $studentMarkPercentage = $this->mark_percentage;

        $eligibility = ScholarshipList::join('applied_scholarships', 'scholarship_lists.id', '=', 'applied_scholarships.scholarship_id')
            ->join('eligibilities', 'scholarship_lists.eligibility_id', '=', 'eligibilities.id')
            ->where('applied_scholarships.mark_percentage', $studentMarkPercentage)
            ->select('eligibilities.*')
            ->get();

        for ($i = 0; $i < count($eligibility); $i++) {
            $minimumMarkPercentages = json_decode($eligibility[$i]['minimumMarkPercentage']);
            $maximumMarkPercentages = json_decode($eligibility[$i]['maximumMarkPercentage']);
            $eligibleAmounts = json_decode($eligibility[$i]['eligibleAmount']);
        }

        for ($i = 0; $i < count($minimumMarkPercentages); $i++) {
            if ($studentMarkPercentage >= $minimumMarkPercentages[$i] && $studentMarkPercentage <= $maximumMarkPercentages[$i]) {
                $eligibleAmount = $eligibleAmounts[$i];
            }
        }

        return $eligibleAmount;
    }
}
