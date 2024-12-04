<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HourlyData extends Model
{
    

    protected $fillable = ['st', 'yt', 'kumes_id']; // Doldurulabilir alanlar

    public function kumes()
    {
        return $this->belongsTo(Kumes::class, 'kumes_id'); // Kümes ile olan ilişki
    }
}
