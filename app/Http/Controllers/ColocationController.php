<?php

namespace App\Http\Controllers;

use App\Http\Requests\ColocationRequest;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pest\Arch\Collections\Dependencies;

class ColocationController extends Controller
{
    public function index()
    {
        $colocation = Colocation::all();
        $colocationUserNumber=User::where('colocation_id',auth()->user()->colocation_id)->count();
        $depenseNumber=Depense::where('colocation_id',auth()->user()->colocation_id)->count();


        return view('colocation', compact('colocation', 'colocationUserNumber','depenseNumber'));
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
