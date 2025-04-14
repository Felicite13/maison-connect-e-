<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'pseudo',
        'age',
        'date_naissance',
        'genre',
        'type_membre',
        'photo_profil',
        'email',
        'password',
        'points',
        'niveau',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function updateNiveau()
    {
        if ($this->points >= 7) {
            $this->niveau = 'expert';
        } elseif ($this->points >= 5) {
            $this->niveau = 'avancé';
        } elseif ($this->points >= 3) {
            $this->niveau = 'intermédiaire';
        } else {
            $this->niveau = 'débutant';
        }

        $this->save(); // On enregistre les modifications dans la base de données
    }
}
