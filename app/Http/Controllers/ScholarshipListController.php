<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\School;
use App\Models\Division;
use App\Models\Department;
use App\Models\Eligibility;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ScholarshipList;

class ScholarshipListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scholarshiplists = ScholarshipList::paginate(4);
        return view('scholarship-list.index', compact('scholarshiplists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schools = School::all();
        $departments  = Department::all();
        $courses = Course::all();
        $divisions = Division::all();
        $year = AcademicYear::all();
        $eligibilities = Eligibility::all();
        return view('scholarship-list.create', compact('schools', 'departments', 'courses', 'divisions', 'year', 'eligibilities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:4',
            'year' => 'required',
            'school' => 'required',
            'department' => 'required',
            'course' => 'required',
            'division' => 'required',
            'eligibility' => 'required',
        ]);

        $scholarship_list = new ScholarshipList();
        $scholarship_list->name = $request->name;
        $scholarship_list->academic_year_id = $request->year;
        $scholarship_list->institution_id = $request->school;
        $scholarship_list->department_id = $request->department;
        $scholarship_list->course_id = $request->course;
        $scholarship_list->division_id = $request->division;
        $scholarship_list->eligibility_id = $request->eligibility;
        $scholarship_list->deadline = Carbon::parse($request->deadline);
        $scholarship_list->status = $request->status;
        $scholarship_list->cover_image = 'scholarship_list.jpg';
        if ($request->cover_image != '') {
            $image_name = "scholarshiplist-" . time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('/images/scholarship_list/'), $image_name);
            $scholarship_list->cover_image = $image_name;
        }
        if ($request->remark != '') {
            $scholarship_list->remark = $request->remark;
        }
        // dd($scholarship_list);
        $scholarship_list->save();

        return redirect()->route('scholarship-list.index')->with('success', 'Scholarship Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scholarshiplists = ScholarshipList::find($id);
        $schools = School::all();
        $departments  = Department::all();
        $courses = Course::all();
        $divisions = Division::all();
        $year = AcademicYear::all();
        $eligibilities = Eligibility::all();
        return view('scholarship-list.edit', compact('scholarshiplists', 'schools', 'departments', 'courses', 'divisions', 'year', 'eligibilities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:4',
            'year' => 'required',
            'school' => 'required',
            'department' => 'required',
            'course' => 'required',
            'division' => 'required',
            'eligibility' => 'required',
        ]);

        $scholarship_list = ScholarshipList::find($id);
        $scholarship_list->name = $request->name;
        $scholarship_list->academic_year_id = $request->year;
        $scholarship_list->institution_id = $request->school;
        $scholarship_list->department_id = $request->department;
        $scholarship_list->course_id = $request->course;
        $scholarship_list->division_id = $request->division;
        $scholarship_list->eligibility_id = $request->eligibility;
        $scholarship_list->deadline = Carbon::parse($request->deadline);
        $scholarship_list->status = $request->status;

        if ($request->cover_image != '') {
            if ($request->cover_image != 'scholarship_list.jpg') {
                unlink(public_path('/images/scholarship_list/' . $scholarship_list->cover_image));
            }
            $image_name = "scholarshiplist-" . time() . '.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('/images/scholarship_list/'), $image_name);
            $scholarship_list->cover_image = $image_name;
        }

        $scholarship_list->remark = $request->remark;

        // dd($scholarship_list);
        $scholarship_list->save();

        return redirect()->route('scholarship-list.index')->with('info', 'Scholarship Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scholarship_list = ScholarshipList::find($id);
        $scholarship_list->delete();

        return redirect()->route('scholarship-list.index')->with('error', 'Scholarship List Deleetd Successfully');
    }

    public function disableStudentList($id)
    {
        $status = ScholarshipList::find($id);

        if ($status->status == 0) {
            $status->update(['status' => 1]);
        } else {
            $status->update(['status' => 0]);
        }

        return redirect()->route('scholarship-list.index')->with('warning', 'Scholarship Status Updated');
    }
}
