<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return view('pages.admin.customers.index');
    }

    public function show($id)
    {
        return view('pages.admin.customers.show');
    }
}
