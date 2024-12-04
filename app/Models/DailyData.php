<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyData extends Model
{
    protected $fillable = ['s1', 's2','os','oo','gu','hs', 'kumes_id']; // Doldurulabilir alanlar

    public function kumes()
    {
        return $this->belongsTo(Kumes::class, 'kumes_id'); // Kümes ile olan ilişki
    }
}
