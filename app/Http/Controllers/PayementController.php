<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\User;
use App\Models\Payement;
use Illuminate\Http\Request;

class PayementController extends Controller
{
    public function index(){
        $payements = Payement::where('colocation_id', auth()->user()->colocation_id)->where('user_id',auth()->user()->id)->get();
        return view('payements',compact('payements'));
    }
   public function Paid($payementId)
{
    $payement = Payement::findOrFail($payementId);
    $user = auth()->user();
    $payer = User::where('name', $payement->payer)->first();



    if ($user->solde >= $payement->my_part) {
        $payement->update(['
        status' => 'paid',
        ]);
        $user->decrement('solde', $payement->my_part);
        $payer->increment('solde', $payement->my_part);

        return redirect()->route('payement.index')
            ->with('success', 'Paiement effectué avec succès.');
    }
    else{
    return redirect()->route('payement.index')
        ->with('error', 'Solde insuffisant pour effectuer ce paiement.');
}
}

}
