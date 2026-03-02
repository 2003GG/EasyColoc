<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user',
        'to_user',
        'colocation_id',
        'status',
    ];

    // The user who sent the invitation
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    // The user who received the invitation
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_user');
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
