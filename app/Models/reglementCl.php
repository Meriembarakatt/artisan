<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReglementCl extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'mode_id',
        'date',
        'montant',
        
    ];

    public function client()
    {
        return $this->belongsTo(Client::class  ,'client_id');
    }

    public function mode()
    {
        return $this->belongsTo(Mode::class, 'mode_id');
    }
  
    
}
