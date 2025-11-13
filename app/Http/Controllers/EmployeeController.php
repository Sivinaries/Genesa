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

        $branch = Branch::select('id', 'name')->get();

        return view('employee', compact('employees', 'branch'));
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

    public function update(Request $request, $id)
    {
        $userCompany = auth()->user()->compani;

        $request->validate([
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

        $data = $request->only(['name', 'branch_id', 'email', 'nik', 'phone', 'address', 'position', 'join_date', 'status', 'role', 'password']);

        $data['compani_id'] = $userCompany->id;

        Employee::where('id', $id)->update($data);

        Cache::forget('employees');

        return redirect(route('employee'))->with('success', 'Employee successfully updated!');
    }

    public function destroy($id)
    {
        Employee::destroy($id);

        Cache::forget('employees');

        return redirect(route('employee'))->with('success', 'Employee Berhasil Dihapus !');
    }
}
