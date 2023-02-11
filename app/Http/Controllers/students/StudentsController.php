<?php

namespace App\Http\Controllers\students;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


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
}
