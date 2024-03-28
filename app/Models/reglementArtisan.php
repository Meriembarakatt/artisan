<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reglementArtisan extends Model
{
    use HasFactory;
    protected $fillable = [
        'artisan_id',
        'mode_id',
        'date',
        'motant',
        
    ];

    public function artisan()
    {
        return $this->belongsTo(Artisan::class  ,'artisan_id');
    }

    public function mode()
    {
        return $this->belongsTo(Mode::class, 'mode_id');
    }
}
