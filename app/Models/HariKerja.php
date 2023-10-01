<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HariKerja extends Model
{
    use HasFactory;
    
    protected $fillable = ['id', 'nm_harikerja', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu', 'minggu'];

    public function users()
    {
        return $this->hasMany(User::class, 'hariKerja_id', 'id');
    }
}
