<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Collections extends Controller
{
    public function index()
	{
		return view('productlist');
	}
}
