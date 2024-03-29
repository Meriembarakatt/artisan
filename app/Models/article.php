<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = [
        'designation',
        'prix_ht',
        'qte',
        'stock',
        'image',
        'sousfamille_id'
    ];

    public function getImageAttribute($value)
    {
        return $value ?: 'images/default.jpg';
    }
    
    public function sousFamille()
    {
        return $this->belongsTo(SousFamille::class, 'sousfamille_id');
    }
}
