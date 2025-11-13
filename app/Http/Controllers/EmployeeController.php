<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class EmployeeController extends Controller
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

        $cacheKey = 'employees';

        $employees = Cache::remember($cacheKey, 60, function () use ($userCompany) {
            return $userCompany->employees()->with('compani', 'branch')->get();
        });

        return view('employee', compact('employees'));
    }

    public function create()
    {
        $branch = Branch::select('id', 'name')->get();
        return view('addemployee', compact('branch'));
    }

    public function store(Request $request)
    {
        $userCompany = auth()->user()->compani;

        $data = $request->validate([
            'name' => 'required',
            'branch_id' => 'required',
            'email' => 'required',
            'nik' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'position' => 'required',
            'join_date' => 'required',
            'status' => 'required',
            'role' => 'required',
            'password' => 'required',
        ]);

        $data['compani_id'] = $userCompany->id;

        Employee::create($data);

        Cache::forget('employees');

        return redirect(route('employee'))->with('success', 'Employee successfully created!');
    }

    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        $branch = Branch::select('id', 'name')->get();
        return view('editemployee', compact('employee', 'branch'));
    }

    public function update(Request $request, $id) {}

    public function destroy($id)
    {
        Employee::destroy($id);

        Cache::forget('employees');

        return redirect(route('employee'))->with('success', 'Employee Berhasil Dihapus !');
    }
}
