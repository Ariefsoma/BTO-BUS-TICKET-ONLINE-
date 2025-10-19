<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return view('admin.dashboard', compact('buses'));
    }
}
