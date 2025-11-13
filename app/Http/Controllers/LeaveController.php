<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LeaveController extends Controller
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

        $cacheKey = 'leaves';

        $leaves = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($userCompany) {
            return $userCompany->leaves()->with('employee')->get();
        });

        return view('leave', compact('leaves'));
    }
    public function create()
    {
        return view('addleave');
    }

    public function store(Request $request)
    {
        $userCompany = auth()->user()->compani;

        $data = $request->validate([
            'employee_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
            'reason' => 'required',
            'status' => 'required',
        ]);

        $data['compani_id'] = $userCompany->id;

        Leave::create($data);

        Cache::forget('leaves');

        return redirect(route('leave'))->with('success', 'Leave successfully created!');
    }

    public function edit($id)
    {
        $leave = Leave::find($id);
        return view('editleave', compact('leave'));
    }

    public function update(Request $request, $id) {}

    public function destroy($id)
    {
        Leave::destroy($id);

        Cache::forget('leaves');

        return redirect(route('leave'))->with('success', 'Leave successfully deleted!');
    }
}
