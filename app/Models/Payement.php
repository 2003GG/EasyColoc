<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    protected $fillable=[
    'user_id',
    'payer',
    'montant',
    'my_part',
    'status',
    'depense_id',
    'colocation_id'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function payer(){
        return $this->belongsTo(User::class,'payer');
    }
    public function depense(){
        return $this->belongsTo(Depense::class);
    }
}
