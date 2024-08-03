<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AdminUsersRequest;

use App\Http\Controllers\Controller;

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
     * Store a newly created user in storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminUsersRequest $request)
    {
        $user = $this->checkAdmin($request);

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
    public function edit(Request $request, $id)
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
    public function update(AdminUsersRequest $request, $id)
    {
        $user = $this->checkAdmin($request);
        $userToUpdate = User::findOrFail($id);

        $userToUpdate->password = bcrypt($request->input('password'));
        $userToUpdate->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
}
