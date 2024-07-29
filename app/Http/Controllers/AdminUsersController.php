<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUsersController extends Controller
{


    protected function checkAdmin(Request $request)
    {
        $user_id = $request->session()->get('user_id');
        $user = User::find($user_id);

        if (!$user || !$user->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        return $user;
    }
    
    public function index(Request $request)
    {
        $user = $this->checkAdmin($request);

        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function destroy(Request $request,$id)
    {
        $user = $this->checkAdmin($request);

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
    public function setAdmin(Request $request,$id)
    {
        $user = $this->checkAdmin($request);

        $user = User::findOrFail($id);
        $user->admin = true;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User set as admin successfully');
    }

    public function removeAdmin(Request $request,$id)
    {
        $user = $this->checkAdmin($request);

        $user = User::findOrFail($id);
        $user->admin = false;
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Admin privileges removed successfully');
    }
    public function store(Request $request)
{
    $user = $this->checkAdmin($request);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
    ]);

    $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password')),
    ]);
    $user->save();

    return redirect()->route('admin.users')->with('success', 'User created successfully');
}

public function editPassword(Request $request, $id)
{
    $user = $this->checkAdmin($request);
    $user = User::findOrFail($id);

    return view('admin.password-edit', compact('user'));
}

public function updatePassword(Request $request, $id)
{
    $user = $this->checkAdmin($request);
    $user = User::findOrFail($id);

    $request->validate([
        'password' => 'required|string|min:6',
    ]);

    $user->password = bcrypt($request->input('password'));
    $user->save();

    return redirect()->route('admin.users')->with('success', 'Password updated successfully');
}


}
