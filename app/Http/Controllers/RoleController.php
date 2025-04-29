<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Show the role pending page.
     */
    public function pending()
    {
        return view('role.pending');
    }
}