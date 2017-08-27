<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AdminUsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /******************************************************************************************************************/

    /**
     * Get a validator for an incoming request.
     *
     * @param  array  $data
     * @return \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'active' => 'required|integer'
        ]);
    }

    /******************************************************************************************************************/

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get all users.
        $users = User::all();

        // Load view from the resource "resources\views\admin\users\index.blade.php"
        return view('admin.users.index', compact('users'));
    }

    /******************************************************************************************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Get list of the roles.
        $roles = Role::pluck('name', 'id')->all();

        // Get possible states for the account status.
        $activeStates = User::getStatusOptions();

        // Load view from the resource "resources\views\admin\users\create.blade.php"
        return view('admin.users.create', compact('roles', 'activeStates'));
    }

    /******************************************************************************************************************/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        // Add new user to the database.
        User::create($request->all());

        // Create toast message for the addition.
        Session::flash('toastMessage', 'User "' . $request->name . '" has been added.');

        // Redirect to the list of the users.
        return redirect()->route('users.index');
    }

    /******************************************************************************************************************/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find user with specific ID.
        $user = User::findOrFail($id);

        // Get list of the roles.
        $roles = Role::pluck('name', 'id')->all();

        // Get possible states for the account status.
        $activeStates = User::getStatusOptions();

        // Load view from the resource "resources\views\admin\users\edit.blade.php"
        return view('admin.users.edit', compact('user', 'roles', 'activeStates'));
    }

    /******************************************************************************************************************/

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, $id)
    {
        // Find user with specific ID.
        $user = User::findOrFail($id);

        // Remove whitespaces and check is new password is provided.
        if (trim($request->password) == '') {
            // New password IS NOT provided, get everything from post except password field.
            $input = $request->except('password');
        } else {
            // New password is provided, get everything from post.
            $input = $request->all();
        }

        // Update the user.
        $user->update($input);

        // Create toast message for edition.
        Session::flash('toastMessage', 'User "' . $request->name . '" has been edited.');

        // Redirect to the list of the users.
        return redirect()->route('users.index');
    }

    /******************************************************************************************************************/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find user with specific ID.
        $user = User::findOrFail($id);

        // Prepare toast message.
        Session::flash('toastMessage', 'User "' . $user->name . '" has been deleted.');

        // Delete user.
        $user->delete();

        // Redirect to the list of the users.
        return redirect()->route('users.index');
    }
}
