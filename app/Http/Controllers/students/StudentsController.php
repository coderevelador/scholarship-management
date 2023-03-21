<?php

namespace App\Http\Controllers\students;

use App\Exports\StudentsExport;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\StudentEducationalDetails;
use Maatwebsite\Excel\Facades\Excel;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = User::role('Student')->get();

        return view('students.adminView.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = User::find($id);
        $user->hasExactRoles(Role::all());
        // dd($user);
        return response()->json($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $students = User::find($id);

        return view('students.adminView.edit', compact('students'));
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
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $user->password;
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->assignRole(['Student']);
        $user->image = $user->image;

        if ($request->image != '') {
            if ($user->image != 'user.jpg') {
                unlink(public_path('/images/user/' . $user->image));
            }
            $image_name = "student-" . time() . '.' . $request->image->extension();
            $request->image->move(public_path('/images/user/'), $image_name);
            $user->image = $image_name;
        }


        $user->save();
        return redirect()->route('students.index')
            ->with('info', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('students.index')
            ->with('error', 'Student deleted successfully.');
    }

    public function exportExcel()
    {
        $data = $this->StudentData();

        return Excel::download(new StudentsExport($data), 'students.xlsx');
    }

    public function exportCSV()
    {
        $data = $this->StudentData();
        
        return Excel::download(new StudentsExport($data), 'students.csv', \Maatwebsite\Excel\Excel::CSV, [
            'Content-Type' => 'text/csv',
        ]);
    }

    public function exportPDF()
    {
        $data = $this->StudentData();

        return Excel::download(new StudentsExport($data), 'students.pdf', \Maatwebsite\Excel\Excel::DOMPDF);
    }

    protected function StudentData()
    {
        $data = User::leftjoin('student_educational_details', 'users.id', '=', 'student_educational_details.student_id')
            ->leftjoin('academic_years', 'student_educational_details.year_id', 'academic_years.id')
            ->leftjoin('departments', 'student_educational_details.department_id', 'departments.id')
            ->leftjoin('courses', 'student_educational_details.course_id', 'courses.id')
            ->leftjoin('divisions', 'student_educational_details.division_id', 'divisions.id')
            ->select('users.id', 'users.name', 'users.email', 'academic_years.year AS year', 'departments.name AS department', 'courses.name AS course', 'divisions.name AS division')->get();
        return $data;
    }
}
