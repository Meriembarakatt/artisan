<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\DetailVente;
class Vente extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'client_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }
    public function details()
    {
        return $this->hasMany(DetailVente::class);
    }
}



