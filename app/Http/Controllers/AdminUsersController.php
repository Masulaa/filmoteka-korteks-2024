<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUsersController extends Controller
{
    /**
     * Check if the current user is an admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
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

    /**
     * Display a listing of the users.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        // Retrieve all users from the database
        $users = User::all();
        
        // Return the view for listing users with the users data
        return view('admin.users', compact('users'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        $userToDelete = User::findOrFail($id);
        $userToDelete->delete();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    /**
     * Set the specified user as an admin.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setAdmin(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        $userToSetAdmin = User::findOrFail($id);
        $userToSetAdmin->is_admin = true;
        $userToSetAdmin->save();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users')->with('success', 'User set as admin successfully');
    }

    /**
     * Remove admin privileges from the specified user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAdmin(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        $userToRemoveAdmin = User::findOrFail($id);
        $userToRemoveAdmin->is_admin = false;
        $userToRemoveAdmin->save();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users')->with('success', 'Admin privileges removed successfully');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param \Illuminate\Http\Request $request
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

        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing the password of the specified user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function editPassword(Request $request, $id)
    {
        $user = $this->checkAdmin($request);
        $userToEdit = User::findOrFail($id);

        return view('admin.password_edit', compact('userToEdit'));
    }

    /**
     * Update the password of the specified user in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, $id)
    {
        $user = $this->checkAdmin($request);
        $userToUpdate = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        $userToUpdate->password = bcrypt($request->input('password'));
        $userToUpdate->save();

        return redirect()->route('admin.users')->with('success', 'Password updated successfully');
    }
}
