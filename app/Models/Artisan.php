<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artisan extends Model
{
    use HasFactory, softDeletes;

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
}
