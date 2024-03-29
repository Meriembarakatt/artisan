<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{ use HasFactory;

   

    protected $fillable = [
        'designation',
        'prix_ht',
        'qte',
        'stock',
        'image',
        'sousfamille_id'
    ];

    public function SousFamille()
   {
       return $this->belongsTo(SousFamille::class, 'sousfamille_id');
    }
  //   public function getImageAttribute(){
      //   return $value??'images/image1.jpg';
  //  } 
}
