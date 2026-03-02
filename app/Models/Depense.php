<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Depense extends Model
{
     use HasFactory;
   protected $fillable=[
    'titre',
    'montant',
    'payer',
    'date',
    'user_id',
    'status',
    'categorie_id',
    'colocation_id',
   ];
   public function userPayer(){
    return $this->belongsTo(User::class,'payer');
   }
   public  function userCreater(){
     return $this->belongsTo(User::class,'user_id');
   }

    public function categorie(){
    return $this->belongsTo(Categorie::class);
   }
   public function colocation(){
    return $this->belongsTo(Colocation::class);
   }
}
