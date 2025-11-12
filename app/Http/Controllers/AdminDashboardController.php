<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;

class AdminDashboardController extends Controller
{
    public function index()
{
    $buses = \App\Models\Bus::all();
    $routes = \App\Models\Route::all();
    $schedules = \App\Models\Schedule::all();

    return view('admin.dashboard', compact('buses', 'routes', 'schedules'));
}

}
