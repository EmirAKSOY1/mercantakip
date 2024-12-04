<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Entegre extends Model
{
    protected $table = 'entegre';

    protected $fillable = [
        'entegre_isim',
    ];


    public function coops()
    {
        return $this->hasMany(Kumes::class);
    }
}
