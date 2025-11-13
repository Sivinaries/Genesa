<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class NoteController extends Controller
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

        $cacheKey = 'notes';

        $notes = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($userCompany) {
            return $userCompany->notes()->with('employee')->get();
        });

        return view('attendance', compact('attendances'));
    }

    public function create()
    {
        return view('addnote');
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Note $note)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        Note::destroy($id);

        Cache::forget('notes');

        return redirect(route('note'))->with('success', 'Note successfully deleted!');
    }
}
