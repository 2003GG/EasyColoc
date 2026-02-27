<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Models\Colocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColocationController extends Controller
{
    public function index()
    {
        $colocation = Colocation::all();
        return view('colocation', compact('colocation'));
    }

    public function store(ColocationRequest $request)
    {
        $validated = $request->validated();

        $colocation = Colocation::create(array_merge($validated, [
            'user_id' => Auth::id(),
            'status'=>'active',
        ]));
        Auth::user()->update([
            'colocation_id' => $colocation->id,
            'status'        => 'owner',
        ]);

        return redirect()->route('dashboard');
    }
}
