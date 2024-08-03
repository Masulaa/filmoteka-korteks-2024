<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    /**
     * Check if the current user is an admin.
     *
     * @return \App\Models\User
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    protected function checkAdmin(Request $request)
    {
        $user_id = $request->user()->id ?? null;
        if (! $user_id) {
            abort(403, 'User not logged in.');
        }

        $user = User::find($user_id);

        if (! $user) {
            abort(403, 'User not found.');
        }

        if (! $user->is_admin) {
            dd('User is not an admin.', $user->is_admin);
            abort(403, 'Unauthorized action.');
        }

        return $user;
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $user = $this->checkAdmin($request);
        $users = User::all();

        return view('admin.users', compact('users'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $userToDelete = User::findOrFail($id);
        $userToDelete->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }

    /**
     * Set the specified user as an admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setAdmin(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $userToSetAdmin = User::findOrFail($id);
        $userToSetAdmin->is_admin = true;
        $userToSetAdmin->save();

        return redirect()->route('admin.users.index')->with('success', 'User set as admin successfully');
    }

    /**
     * Remove admin privileges from the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAdmin(Request $request, $id)
    {
        $user = $this->checkAdmin($request);

        $userToRemoveAdmin = User::findOrFail($id);
        $userToRemoveAdmin->is_admin = false;
        $userToRemoveAdmin->save();

        return redirect()->route('admin.users.index')->with('success', 'Admin privileges removed successfully');
    }

    /**
     * Store a newly created user in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the user.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function editUser(Request $request, $id)
    {
        $user = $this->checkAdmin($request);
        $userToEdit = User::findOrFail($id);

        return view('admin.user_edit', compact('userToEdit'));
    }

    /**
     * Update the user in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateUser(Request $request, $id)
    {
        $user = $this->checkAdmin($request);
        $userToUpdate = User::findOrFail($id);

        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $userToUpdate->password = bcrypt($request->input('password'));
        $userToUpdate->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
}
