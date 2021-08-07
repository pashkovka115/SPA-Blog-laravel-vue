<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


class FrontendController extends Controller
{
    // For public application
    public function app()
    {
        return view('app');
    }

    // For admin application
    public function admin()
    {
        return view('welcome');
    }
}
