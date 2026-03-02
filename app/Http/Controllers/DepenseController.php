<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;

use App\Models\Categorie;
use App\Models\Colocation;
use App\Models\Depense;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DepenseController extends Controller
{
    public function index(){
    $colocationId = auth()->user()->colocation->id;
    $categories = Categorie::where('colocation_id', $colocationId)->get();
    $depenses = Depense::where('colocation_id', $colocationId)->get();
    $users = User::where('colocation_id', $colocationId)->get();

       return view('dashboard',compact('categories','users','depenses'));

    }
    public function store(StorePostRequest $request)
    {
        Depense::create([
            'user_id'=>auth()->user()->id,
            'titre'        => $request->titre,
            'montant'      => $request->montant,
            'date'         => $request->date,
            'categorie_id' => $request->categorie,
            'payer'        => $request->payer,
            'colocation_id'=> auth()->user()->colocation->id,
            'status'=>'notpayed',

        ]);

        return redirect()->route('dashboard');
    }
}
