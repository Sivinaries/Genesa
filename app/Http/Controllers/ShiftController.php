<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ShiftController extends Controller
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

        $cacheKey = 'shifts';

        $shifts = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($userCompany) {
            return $userCompany->shifts()->with('employee')->get();
        });

        return view('shift', compact('shifts'));
    }

    public function create()
    {
        return view('addshift');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
        $shift = Shift::find($id);
        return view('editshift', compact('shift'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Shift::destroy($id);

        Cache::forget('shifts');

        return redirect(route('shift'))->with('success', 'Shiift successfully deleted!');
    }
}
