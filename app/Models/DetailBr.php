<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBr extends Model
{
    use HasFactory;

    protected $table = 'detail__brs';

    protected $fillable = [
        'article_id',
        'br_id',
        'qte',
        'prix',
    ];
    // Définition des relations avec les autres modèles si nécessaire
    public function article()
    {
        return $this->belongsTo(article::class, 'article_id');
    }

    public function bonreception()
    {
        return $this->belongsTo(Bonreseption::class, 'br_id');
    }
}
