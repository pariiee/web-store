<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;

class InformationController extends Controller
{
    public function index()
    {
        return view('guest.information');
    }
}
