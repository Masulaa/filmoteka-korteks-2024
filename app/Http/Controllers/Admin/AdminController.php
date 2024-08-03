<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
