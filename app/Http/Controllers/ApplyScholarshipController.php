<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\ScholarshipList;
use App\Models\AppliedScholarship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ApplyScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $scholarshiplists = DB::table('scholarship_lists')
            ->join('student_educational_details', function ($join) {
                $join->on('scholarship_lists.academic_year_id', '=', 'student_educational_details.year_id')
                    ->on('scholarship_lists.department_id', '=', 'student_educational_details.department_id')
                    ->on('scholarship_lists.course_id', '=', 'student_educational_details.course_id');
            })
            ->where('scholarship_lists.deadline', '>=', Carbon::today()->toDateString()) //expiry filter
            ->select('scholarship_lists.*', DB::raw('(SELECT name FROM academic_years WHERE id = scholarship_lists.academic_year_id) AS yearname, (SELECT name FROM departments WHERE id = scholarship_lists.department_id) AS department, (SELECT name FROM courses WHERE id = scholarship_lists.course_id) AS course'))
            ->paginate(4);

        // Applied check

        $appliedApplication = DB::table('applied_scholarships')
            ->join('scholarship_lists', 'scholarship_lists.id', '=', 'applied_scholarships.scholarship_id')
            ->join('users', 'users.id', '=', 'applied_scholarships.student_id')
            ->where('users.id', '=', Auth::user()->id)
            ->pluck('applied_scholarships.scholarship_id');

        // dd($appliedApplication);

        return view('students.apply_scholarship.index', compact('scholarshiplists', 'appliedApplication'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $appliedScholarship = AppliedScholarship::find($id);

        return view('students.apply_scholarship.edit', compact('appliedScholarship'));
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
            'annual_income' => 'required',
            'mark_percentage' => 'required',
        ]);

        $appliedScholarship = AppliedScholarship::find($id);
        $appliedScholarship->scholarship_id = $appliedScholarship->scholarship_id;
        $appliedScholarship->student_id = $appliedScholarship->student_id;
        $appliedScholarship->annual_income = $request->annual_income;
        $appliedScholarship->mark_percentage = $request->mark_percentage;
        $appliedScholarship->submission_date = $appliedScholarship->submission_date;
        $appliedScholarship->status = $request->status;

        if (!empty($request->payment_receipt)) {
            if (!empty($appliedScholarship->payment_receipt)) {
                unlink(public_path('payment-receipt/' . $appliedScholarship->payment_receipt));
            }
            $file_name = "payment-receipt-" . time() . '.' . $request->payment_receipt->extension();
            $request->payment_receipt->move(public_path('/payment-receipt'), $file_name);
            $appliedScholarship->payment_receipt = $file_name;
        }
        // dd($appliedScholarship);
        $appliedScholarship->save();

        return redirect()->route('scholarship-list.index')->with('info', 'Successfully Updated the Scholarship');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appliedScholarship = AppliedScholarship::find($id);

        if (!empty($appliedScholarship->payment_receipt)) {
            unlink(public_path('payment-receipt/' . $appliedScholarship->payment_receipt));
        }
        $appliedScholarship->delete();
        return redirect()->route('scholarship-list.index')->with('error', 'Successfully Deleted the Scholarship');
    }
    public function applyScholarship($id)
    {
        $applyScholarship = ScholarshipList::find($id);

        return view('students.apply_scholarship.create', compact('applyScholarship'));
    }
    // store applied scholarship

    public function storeAppliedScholarship($id, Request $request)
    {

        $request->validate([
            'annual_income' => 'required',
            'mark_percentage' => 'required',
        ]);

        $appliedScholarship = new AppliedScholarship();
        $appliedScholarship->scholarship_id = $id;
        $appliedScholarship->student_id = $request->student_id;
        $appliedScholarship->annual_income = $request->annual_income;
        $appliedScholarship->mark_percentage = $request->mark_percentage;
        $appliedScholarship->submission_date = Carbon::now();
        $appliedScholarship->status = 'pending';
        // dd($appliedScholarship);
        $appliedScholarship->save();

        return redirect()->route('apply-scholarship.index')->with('success', 'Successfully Applied the Scholarship');
    }

    public function updateAppliedScholarship(Request $request, $id)
    {
    }

    public function eligibilityIncome(Request $request)
    {
        $annualIncome = $request->input('annual_income');

        $incomeElibility = DB::table('eligibilities')
            ->join('scholarship_lists', 'scholarship_lists.eligibility_id', '=', 'eligibilities.id')
            ->select('eligibilities.income')
            ->first();
        $incomeElibility = $incomeElibility->income;

        if ($annualIncome >  $incomeElibility) {
            return response()->json([
                'message' => 'You are not eligible for this scholarship'
            ], 400);
        }
    }
    public function MarkPercentage(Request $request)
    {
        $MarkPercentage = $request->input('mark_percentage');

        $MarkPercentageElibility = DB::table('eligibilities')
            ->join('scholarship_lists', 'scholarship_lists.eligibility_id', '=', 'eligibilities.id')
            ->select('eligibilities.minimumPercentage')
            ->first();
        $MarkPercentageElibility = $MarkPercentageElibility->minimumPercentage;

        if ($MarkPercentage <  $MarkPercentageElibility) {
            return response()->json([
                'message' => 'You are not eligible for this scholarship'
            ], 400);
        }

        if ($MarkPercentage >  100) {
            return response()->json([
                'message' => 'Mark Percentage must less than or equal to 100'
            ], 406);
        }
    }

    // Student Applied Scholarship Status

    public function statusAppliedScholarship($id)
    {

        $appliedStatus = AppliedScholarship::find($id)->get();
        // dd($appliedStatus);

        return view('students.apply_scholarship.status', compact('appliedStatus'));
    }
}
