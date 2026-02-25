<?php

namespace App\Http\Controllers;
use App\Http\Requests\StorePostRequest;

use App\Models\Categorie;
use App\Models\Colocation;
use App\Models\Depense;
use Illuminate\Http\Request;

class DepenseController extends Controller
{
    public function index(){
       $categories=Categorie::all();
       $depenses=Depense::all();
       $colocations=Colocation::all();
       return view('dashboard',compact('categories','depenses','colocations'));

    }
      public function store(StorePostRequest $request)
    {

        $validated = $request->validated();

        Depense::create($validated);

        return redirect()->route('depense.index');
    }
}
