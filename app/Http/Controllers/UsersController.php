<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::latest()->paginate(10);

        return view('users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name', '!=', 'Super-Admin')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request)
    {

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->assignRole([$request->role]);
        $user->image = 'user.jpg';
        if ($request->image != '') {
            $image_name = "user-" . time() . '.' . $request->image->extension();
            $request->image->move(public_path('/images/user/'), $image_name);
            $user->image = $image_name;
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show($id)
    {

        $user = User::find($id);
        $user->hasExactRoles(Role::all());

        return response()->json($user);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $roles = Role::where('name', '!=', 'Super-Admin')->get();
       
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = $user->password;
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->assignRole([$request->role]);
        $user->image = $user->image;
        if ($request->image != 'user.jpg') {
            if ($request->image != '') {
                $image_name = "user-" . time() . '.' . $request->image->extension();
                $request->image->move(public_path('/images/user/'), $image_name);
                $user->image = $image_name;
            }
        }


        $user->syncRoles($request->get('role'));
        $user->save();
        return redirect()->route('users.index')
            ->with('info', 'User updated successfully.');
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('error', 'User deleted successfully.');
    }
}
