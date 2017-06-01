<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pegawaiController extends Controller
{
    public function login()
    {
    	return view('admin.login');
    }
}
