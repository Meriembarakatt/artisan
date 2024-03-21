<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artisan extends Model
{
    use HasFactory;

    protected $table = 'artisans';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'adress',
        'ville',
        'fonction'
    ];
}
