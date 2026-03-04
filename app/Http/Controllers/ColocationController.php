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
        $usersColocation=User::all()->where('colocation_id',auth()->user()->colocation_id);
        $colocationUserNumber=User::where('colocation_id',auth()->user()->colocation_id)->count();
        $depenseNumber=Depense::where('colocation_id',auth()->user()->colocation_id)->count();



        return view('colocation', compact('colocation', 'colocationUserNumber','depenseNumber','usersColocation'));
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
    public function cancel()
    {
      $user=auth()->user();
      $user->update([
        'colocation_id'=>null,
        'status'=>'member',
      ]);
      if($user->payement()->sum('my_part') >= 0){
        $user->increment('note');
      }
      else{
        $user->decrement('note');

      }


        return redirect()->route('dashboard');
    }
}
