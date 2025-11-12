<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AttendanceController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/');
        }

        $userCompany = Auth::user()->compani;

        if (!$userCompany) {
            return redirect()->route('addcompany');
        }

        $status = $userCompany->status;

        if ($status !== 'Settlement') {
            return redirect()->route('login');
        }

        $cacheKey = 'attendances';

        $attendances = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($userCompany) {
            return $userCompany->attendances;
        });

        return view('attendance', compact('attendances'));
    }

    public function create()
    {
        return view('addattendance');
    }

    public function store(Request $request)
    {
        $userCompany = auth()->user()->compani;

        $data = $request->validate([
            'employee_id' => 'required',
            'attendance_date' => 'required',
            'clock_in' => 'required',
            'clock_out' => 'required',
            'status' => 'required',
        ]);

        $data['compani_id'] = $userCompany->id;

        Attendance::create($data);

        Cache::forget('attendances');

        return redirect(route('attendance'))->with('success', 'Attendance successfully created!');
    }

    public function edit($id)
    {
        $attendance = Attendance::find($id);

        return view('editattendance', compact('attendance'));
    }

    public function update(Request $request, $id)
    {
        $userStore = auth()->user()->store;

        $request->validate([
            'name' => 'required | unique:categories,name,NULL,id,store_id,' . $userStore->id,
        ]);

        $data = $request->only(['name']);

        $data['store_id'] = $userStore->id;

        Category::where('id', $id)->update($data);

        Cache::forget('categories');

        return redirect(route('category'))->with('success', 'Category successfully updated!');
    }

    public function destroy($id)
    {
        Category::destroy($id);

        Cache::forget('categories');

        return redirect(route('category'))->with('success', 'Category successfully deleted!');
    }
}
