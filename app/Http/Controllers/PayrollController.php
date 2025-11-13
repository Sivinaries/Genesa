<?php

namespace App\Http\Controllers;

use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PayrollController extends Controller
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

        $cacheKey = 'payrolls';

        $payrolls = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($userCompany) {
            return $userCompany->payrolls()->with('employee')->get();
        });

        return view('payroll', compact('payrolls'));
    }

    public function create()
    {
        return view('addpayroll');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit($id)
    {
         $payroll = Payroll::find($id);
        return view('editpayroll', compact('payroll'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Payroll::destroy($id);

        Cache::forget('payrolls');

        return redirect(route('payroll'))->with('success', 'Payroll successfully deleted!');
    }
}
