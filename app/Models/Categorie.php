<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Categorie extends Model
{
     use HasFactory;
    protected $fillable=[
        'title',
        'colocation_id',
    ];
    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
    public function depense(){
        return $this->hasMany(Depense::class);
    }
}
