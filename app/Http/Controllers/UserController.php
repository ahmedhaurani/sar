<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Department; // Add the Department model
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:update user', ['only' => ['update', 'edit']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    public function index()
    {
        $users = User::get();
        return view('role-permission.user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        $departments = Department::pluck('name', 'id')->all(); // Fetch all departments
        return view('role-permission.user.create', [
            'roles' => $roles,
            'departments' => $departments // Pass departments to the view
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required',
            'departments' => 'required|array' // Validate departments
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roles);
        $user->departments()->sync($request->departments); // Assign departments

        return redirect('/users')->with('status', 'User created successfully with roles and departments');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'name')->all();
        $userRoles = $user->roles->pluck('name', 'name')->all();
        $departments = Department::pluck('name', 'id')->all(); // Fetch all departments
        $userDepartments = $user->departments->pluck('id')->toArray(); // Fetch user's departments

        return view('role-permission.user.edit', [
            'user' => $user,
            'roles' => $roles,
            'userRoles' => $userRoles,
            'departments' => $departments, // Pass departments to the view
            'userDepartments' => $userDepartments // Pass user's assigned departments
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required',
            'departments' => 'required|array' // Validate departments
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        $user->syncRoles($request->roles);
        $user->departments()->sync($request->departments); // Sync departments

        return redirect('/users')->with('status', 'User updated successfully with roles and departments');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect('/users')->with('status', 'User deleted successfully');
    }
}
