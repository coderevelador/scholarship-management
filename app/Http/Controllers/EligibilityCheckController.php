<?php

namespace App\Http\Controllers;

use App\Models\Eligibility;
use Illuminate\Http\Request;

class EligibilityCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eligibilities = Eligibility::orderBy('id', 'DESC')->get();
        // dd($eligibilities);
        return view('eligibility-check.index', compact('eligibilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('eligibility-check.create');
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
            'name' => 'required|unique:eligibilities',
            'income' => 'required',
            'percentageCondition' => 'required',
        ]);



        $data = [
            'name' => $request->input('name'),
            'income' => $request->input('income'),
            'minimumPercentage' => $request->input('minimumPercentage'),
            'minimumMarkPercentage' => json_encode($request->input('minimumMarkPercentage')),
            'percentageCondition' => json_encode($request->input('percentageCondition')),
            'maximumMarkPercentage' => json_encode($request->input('maximumMarkPercentage')),
            'eligibleAmount' => json_encode($request->input('eligibleAmount')),
        ];


        Eligibility::create($data);

        return redirect()->route('eligibility.index')->with("success", "Eligiblity Added Successfully");
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
        $eligibilities = Eligibility::find($id);

        //  dd(json_decode($eligibilities));
        return view('eligibility-check.edit')->with('eligibilities', json_decode($eligibilities, true));
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
            'name' => 'required',
            'income' => 'required',
            'percentageCondition' => 'required',
        ]);



        $data = [
            'name' => $request->input('name'),
            'income' => $request->input('income'),
            'minimumPercentage' => $request->input('minimumPercentage'),
            'minimumMarkPercentage' => json_encode($request->input('minimumMarkPercentage')),
            'percentageCondition' => json_encode($request->input('percentageCondition')),
            'maximumMarkPercentage' => json_encode($request->input('maximumMarkPercentage')),
            'eligibleAmount' => json_encode($request->input('eligibleAmount')),
        ];


        $eligibilities = Eligibility::find($id);

        $eligibilities->update($data);

        return redirect()->route('eligibility.index')->with("info", "Eligiblity Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eligibilities = Eligibility::find($id);

        $eligibilities->delete();

        return redirect()->route('eligibility.index')->with("error", "Eligiblity Deleted Successfully");
    }
}
