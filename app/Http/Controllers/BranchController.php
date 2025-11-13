<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class BranchController extends Controller
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

        $cacheKey = 'branches';

        $branches = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($userCompany) {
            return $userCompany->branches;
        });

        return view('branch', compact('branches'));
    }

    public function store(Request $request)
    {
        $userCompany = auth()->user()->compani;

        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $data['compani_id'] = $userCompany->id;

        Branch::create($data);

        Cache::forget('branches');

        return redirect(route('branch'))->with('success', 'Branch successfully created!');
    }

    public function update(Request $request, $id)
    {
        $userCompany = auth()->user()->compani;

        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
        ]);

        $data = $request->only(['name', 'address', 'phone']);

        $data['compani_id'] = $userCompany->id;

        Branch::where('id', $id)->update($data);

        Cache::forget('branches');

        return redirect(route('branch'))->with('success', 'Branch successfully updated!');
    }

    public function destroy($id)
    {
        Branch::destroy($id);

        Cache::forget('branches');

    return redirect(route('branch'))->with('success', 'Branch successfully deleted!');
    }
}
