<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;

use App\Models\Categorie;
use App\Models\Colocation;
use App\Models\Depense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DepenseController extends Controller
{
    public function index(){
       $categories=Categorie::all();
       $depenses=Depense::all();
       $colocations=Colocation::all();
    //    $totalDepenses=Depense::all()->montant->count();
       return view('dashboard',compact('categories','depenses','colocations'));

    }
      public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $categorieId=$request->categorie()->id;
        $payer=$request->user()->colocation()->id;
        Depense::create(array_merge($validated,[
                'Categorie_id'=>$categorieId,
                'payer'=>$payer,
        ]));

        return redirect()->route('dashboard');
    }
}
