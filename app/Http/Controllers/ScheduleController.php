<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule; // pastikan kamu punya model Schedule

class ScheduleController extends Controller
{
    public function index()
    {
        // Ambil semua data jadwal dari tabel 'schedule'
        $schedules = Schedule::all();

        // Kirim ke view
        return view('admin.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('admin.schedules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'is_available' => 'required|boolean',
            'user_id' => 'nullable|integer',
        ]);

        Schedule::create($request->all());

        return redirect()->route('admin.schedule.index')
            ->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('admin.schedule.index')
            ->with('success', 'Jadwal berhasil dihapus.');
    }
}
