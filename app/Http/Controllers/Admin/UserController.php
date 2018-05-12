<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function profile()
    {
        return view('sites.profile.profile');
    }

    public function profileUpdate(Request $request)
    {
        dd($request->all());
    }
}
