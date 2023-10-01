<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'nm_shift'];

    public function users()
    {
        return $this->hasMany(User::class, 'shift_id', 'id');
    }

    public function shiftDetails()
    {
        return $this->hasMany(ShiftDetail::class, 'shift_id', 'id');
    }
}
