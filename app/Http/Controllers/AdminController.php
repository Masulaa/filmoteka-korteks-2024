<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Return the view for the admin dashboard
        return view('admin.index');
    }
}
