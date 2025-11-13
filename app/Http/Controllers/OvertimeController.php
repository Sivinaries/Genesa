<?php

namespace App\Http\Controllers;

use App\Models\Overtime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class OvertimeController extends Controller
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

        $cacheKey = 'overtimes';

        $overtimes = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($userCompany) {
            return $userCompany->overtimes()->with('employee')->get();
        });

        return view('overtime', compact('overtimes'));
    }

    public function create()
    {
        return view('addovertime');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Overtime $overtime)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Overtime::destroy($id);

        Cache::forget('overtimes');

        return redirect(route('overtime'))->with('success', 'Overtime successfully deleted!');
    }
}
