<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'designation',
        'prix_ht',
        'qte',
        'stock',
        'photo',
        'sousfamille_id'
    ];

    public function SousFamille()
    {
        return $this->belongsTo(SousFamille::class, 'sousfamille_id');
    }
}
