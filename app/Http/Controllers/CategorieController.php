<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategorieRequest;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function index(){
        $categories=Categorie::all()->where('colocation_id',auth()->user()->colocation_id);
        return view('categories',compact('categories'));
    }
    public function store(CategorieRequest $request){
        Categorie::create([
            'title'=>$request->title,
            'colocation_id'=>auth()->user()->colocation->id,
        ]);
            return redirect()->route('categorie.index');

    }
}
