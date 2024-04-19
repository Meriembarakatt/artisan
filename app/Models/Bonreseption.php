<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bonreseption extends Model
{
    use HasFactory;

    protected $table = 'bonreseptions';

    protected $fillable = [
        'date',
        'artisan_id',
    ];

    public function artisan()
    {
        return $this->belongsTo(Artisan::class, 'artisan_id');
    }
    public function details()
    {
        return $this->hasMany(DetailBr::class);
    }// Dans votre modèle Vente (app\Models\Vente.php)
}
