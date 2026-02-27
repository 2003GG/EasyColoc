<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Invitation;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'note',
        'status',
        'colocation_id',
        'condition',
        'solde',
        'password',
    ];
       public function role(){
        return $this->belongsTo(Role::class);
    }
    public function depanse(){
        return $this->hasMany(Depense::class);
    }
    public function colocation(){
        return $this->belongsTo(Colocation::class);
    }
    public function invitations(){
        return $this->hasMany(Invitation::class, 'from_user' );
    }

    public function receivedInvitations()
{
    return $this->hasMany(Invitation::class, 'to_user');
}

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

}
