<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisan extends Model
{
    use HasFactory;

    protected $table = 'artisans';

    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'email',
        'password',
        'adress',
        'ville',
        'fonction',
        'tell',
        'deleted_at',
    ];

    public function reglements()
    {
        return $this->hasMany(reglementArtisan::class);
    }
    
}


