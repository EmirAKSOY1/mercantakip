<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Kumes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        'entegre_id',
    ];

    public function endkonData()
    {
        return $this->hasMany(EndkonData::class,'KUMES_ID');
    }
    public function dailyData()
    {
        return $this->hasMany(DailyData::class,'kumes_id');
    }
    public function hourlyData()
    {
        return $this->hasMany(HourlyData::class,'kumes_id');
    }
    public function endkonAriza()
    {
        return $this->hasMany(EndkonAriza::class);
    }
    public function entegre()
    {
        return $this->belongsTo(related: Entegre::class);
    }
}
