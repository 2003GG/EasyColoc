<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Colocation extends Model
{
     use HasFactory;
    protected $fillable=[
        'name',
        'user_id',
        'status',


    ];
    public function user(){
        return $this->hasMany(User::class);
    }

    public function categorie(){
        return $this->hasMany(Categorie::class);
    }
     public function depense(){
        return $this->hasMany(Depense::class);
    }
    public function invitaion(){
        return $this->hasMany(Invitation::class);
    }
}
