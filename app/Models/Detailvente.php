<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailvente extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'vente_id',
        'qte',
        'prix',
    ];

    public function article()
    {
        return $this->belongsTo(article::class  ,'article_id');
    }

    public function vente()
    {
        return $this->belongsTo(Vente::class, 'vente_id');
    }
}
