<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['auth', 'permission_clearance']);
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $this->validate($request,
         [
             'name' => 'required|min:3',
             'email' => 'required|email|unique:users',
             'password' => 'required|min:8|confirmed',
             'image' => 'required|image',
             'roles' => 'required'
     ]);
         */
        $user =  new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = $request['password'];


        if($request->hasFile('image')) {

            $file = $request->file('image');

            $destination_path = 'images/users';
            $name = $file->getClientOriginalName();
            $file->move($destination_path, $name);
            $file_extension = $file->getClientOriginalExtension();

            $user->image = $name;
        }
        $user->save();


        $roles = $request['roles'];

        if($roles != ''){
            $user->roles()->attach($roles);
        }

        return redirect()->route('users.index')->with('success', 'User Successfully Created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        return view('users.show', compact('user', 'roles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::get();
        return view('users.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);
        $this->validate($request,
            [
                'name' => 'required|min:5',
                'email' => 'required|email|unique:users,email'.$id,
                'password' => 'required|min:8|confirmed',
                'roles' => 'required'
            ]);

        $input = $request->except('roles');
        $user->fill($input)->save();

        $roles = $request['roles'];

        if ($roles != '') {
            $user->roles()->sync($roles);
        }
        else {
            $user->roles()->detach();
        }
        return redirect()->route('users.show')->with('success',
            'User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User Successfully Deleted');
    }
}
