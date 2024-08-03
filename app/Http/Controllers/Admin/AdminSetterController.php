<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;

class AdminSetterController extends Controller
{

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

}
