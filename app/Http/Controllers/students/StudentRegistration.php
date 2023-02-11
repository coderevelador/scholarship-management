<?php

namespace App\Http\Controllers\students;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentRegistration extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('students.registration.create');
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
        $request->validate([
            'name' => 'required|min:4',
            'username' => 'required|min:4|unique:users',
            'email' => 'required|min:4|unique:users',
            'password' => 'required|min:8',
        ]);

        $student = new User();
        $student->name = $request->name;
        $student->username = $request->username;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);

        $student->assignRole(['Student']);
        $student->image = 'user.jpg';
        if ($request->image != '') {
            $image_name = "student-" . time() . '.' . $request->image->extension();
            $request->image->move(public_path('/images/students/'), $image_name);
            $student->image = $image_name;
        }

        $student->save();

        return redirect()->route('login')->with('success', 'Registration Success');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
