<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;

use App\Models\Categorie;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\User;
use App\Models\Payement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DepenseController extends Controller
{
    public function index(){
    $colocationId = auth()->user()->colocation_id;
    $categories = Categorie::where('colocation_id', $colocationId)->get();
    $depenses = Depense::where('colocation_id', $colocationId)->get();
    $users = User::where('colocation_id', $colocationId)->get();

       return view('dashboard',compact('categories','users','depenses'));

    }
public function store(StorePostRequest $request)
{
    $colocationId = auth()->user()->colocation_id;

    $depense = Depense::create([
        'user_id'       => auth()->id(),
        'titre'         => $request->titre,
        'montant'       => $request->montant,
        'date'          => $request->date,
        'categorie_id'  => $request->categorie,
        'payer'         => $request->payer,
        'colocation_id' => $colocationId,
        'status'        => 'notpayed',
    ]);

    $payer = User::findOrFail($request->payer);
    $members = User::where('colocation_id', $colocationId)->get();

    
    $partOfMontant = $depense->montant / $members->count();

    foreach ($members as $user) {
        if ($user->id == $payer->id) {
            continue;
        }

        Payement::create([
            'user_id'       => $user->id,
            'payer'         => $payer->name,
            'montant'       => $request->montant,
            'my_part'       => $partOfMontant,
            'status'        => 'notpaid',
            'depense_id'    => $depense->id,
            'colocation_id' => $colocationId,
        ]);
    }

    return redirect()->route('dashboard');
}
}
