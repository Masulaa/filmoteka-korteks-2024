<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUsersController extends Controller
{
    protected function checkAdmin(Request $request)
{
    $user_id = $request->user()->id ?? null;
    if (!$user_id) {
        abort(403, 'User not logged in.');
    }

    $user = User::find($user_id);

    if (!$user) {
        abort(403, 'User not found.');
    }

    if (!$user->is_admin) {
        dd('User is not an admin.', $user->is_admin); 
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

    public function destroy(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $userToDelete = User::findOrFail($id);
        $userToDelete->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    public function setAdmin(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $userToSetAdmin = User::findOrFail($id);
        $userToSetAdmin->is_admin = true;
        $userToSetAdmin->save();

        return redirect()->route('admin.users')->with('success', 'User set as admin successfully');
    }

    public function removeAdmin(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $userToRemoveAdmin = User::findOrFail($id);
        $userToRemoveAdmin->is_admin = false;
        $userToRemoveAdmin->save();

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

        $newUser = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $newUser->save();

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    public function editPassword(Request $request, $id)
{
    $user = $this->checkAdmin($request);
    $userToEdit = User::findOrFail($id);

    return view('admin.password_edit', compact('userToEdit'));
}


public function updatePassword(Request $request, $id)
{
    $user = $this->checkAdmin($request);
    $userToUpdate = User::findOrFail($id);

    $request->validate([
        'password' => 'required|string|min:6',
    ]);

    $userToUpdate->password = bcrypt($request->input('password'));
    $userToUpdate->save();

    return redirect()->route('admin.users')->with('success', 'Password updated successfully');
}

}
