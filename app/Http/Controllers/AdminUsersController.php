<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUsersController extends Controller
{
    /**
     * Check if the authenticated user is an admin.
     *
     * @param \Illuminate\Http\Request $request
     * @return \App\Models\User
     */
    protected function checkAdmin(Request $request)
    {
        // Get the user ID from the session
        $user_id = $request->session()->get('user_id');
        $user = User::find($user_id);

        // Ensure the user exists and is an admin
        if (!$user || !$user->is_admin) {
            abort(403, 'Unauthorized action.');
        }

        return $user;
    }

    /**
     * Display a listing of all users in the admin panel.
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
     * Remove the specified user from the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        // Find the user by ID or fail if not found
        $user = User::findOrFail($id);
        
        // Delete the user from the database
        $user->delete();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }

    /**
     * Grant admin privileges to a user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setAdmin(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        // Find the user by ID or fail if not found
        $user = User::findOrFail($id);
        
        // Set the user as an admin
        $user->admin = true;
        $user->save();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users')->with('success', 'User set as admin successfully');
    }

    /**
     * Remove admin privileges from a user.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeAdmin(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        // Find the user by ID or fail if not found
        $user = User::findOrFail($id);
        
        // Remove admin privileges from the user
        $user->admin = false;
        $user->save();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users')->with('success', 'Admin privileges removed successfully');
    }

    /**
     * Show the form for creating a new user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Create a new user instance with the validated data
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);
        $user->save();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users')->with('success', 'User created successfully');
    }

    /**
     * Show the form for editing a user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function editPassword(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        // Find the user by ID or fail if not found
        $user = User::findOrFail($id);

        // Return the view for editing the user's password
        return view('admin.password-edit', compact('user'));
    }

    /**
     * Update the specified user's password.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request, $id)
    {
        // Ensure the user is an admin before proceeding
        $user = $this->checkAdmin($request);

        // Find the user by ID or fail if not found
        $user = User::findOrFail($id);

        // Validate the request data
        $request->validate([
            'password' => 'required|string|min:6',
        ]);

        // Update the user's password
        $user->password = bcrypt($request->input('password'));
        $user->save();

        // Redirect to the users index with a success message
        return redirect()->route('admin.users')->with('success', 'Password updated successfully');
    }
}
