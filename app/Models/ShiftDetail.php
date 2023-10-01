<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftDetail extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'hari', 'jam_masuk', 'jam_keluar', 'dispensasi', 'shift_id'];

    public function shifts()
    {
        return $this->belongsTo(Shift::class, 'shift_id', 'id');
    }
}
