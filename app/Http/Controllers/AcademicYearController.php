<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years =  AcademicYear::all();

        return view('academic-year.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('academic-year.create');
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
            'year' => 'required|unique:academic_years'
        ]);
        $year = new AcademicYear();
        // dd($year->year = $request->year);

        $year->year = $request->year;
        $year->save();

        return redirect()->route('academic-year.index')->with('success', 'Academic Year Added Successfully');
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
        $years =  AcademicYear::find($id);

        return view('academic-year.edit', compact('years'));
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
            'year' => 'required|unique:academic_years', $id
        ]);

        $year =  AcademicYear::find($id);
        $year->year = $request->year;
        $year->update();

        return redirect()->route('academic-year.index')->with('info', 'Academic Year Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $year =  AcademicYear::find($id);
        $year->delete();

        return redirect()->route('academic-year.index')->with('error', 'Academic Year Deleted Successfully');
    }
}
