<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    /** @use HasFactory<\Database\Factories\InvitationFactory> */
    use HasFactory;
    protected $fillable=[
        'from_user',
        'to_user',
        'colocation_id',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class , );
    }
        public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
}
