<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';

    protected $fillable = [
        'nom',
        'prenom',
        'tell',
        'email',
        'adress',
        'ville',
      
    ];
    public function reglements()
    {
        return $this->hasMany(ReglementCl::class);
    }
}
