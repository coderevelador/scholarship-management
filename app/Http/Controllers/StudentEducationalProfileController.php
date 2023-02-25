<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Course;
use App\Models\Department;
use App\Models\Division;
use App\Models\StudentEducationalDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentEducationalProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user()->id;
        $educations = StudentEducationalDetails::where('student_id', $user)->first();

        $years = AcademicYear::all();
        // dd( $year);
        $departments = Department::all();
        $courses = Course::all();
        $divisions = Division::all();

        return view('students.education_details.index', compact('educations', 'years', 'departments', 'courses', 'divisions'));
    }
    public function store(Request $request)
    {
        $education = new StudentEducationalDetails();
        $student_id = Auth::user()->id;
        $education->student_id = $student_id;
        $education->year_id = $request->year_id;
        $education->department_id = $request->department_id;
        $education->course_id = $request->course_id;
        $education->division_id = $request->division_id;
        // dd($education);
        $education->save();

        return redirect()->route('student.education')->with('success', 'Education Added Successfully');
    }
}
