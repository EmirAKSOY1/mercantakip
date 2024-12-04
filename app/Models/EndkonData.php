<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndkonData extends Model
{
     
     protected $table = 'endkon_data';
     public $timestamps = false;
     
     protected $fillable = [
         'tarih',
         'SN',
         'ISI',
         'DI',
         'SE',
         'NE',
         'CO',
         'KUMES_ID',
     ];
 
     
     public function kumes()
     {
         return $this->belongsTo(Kumes::class, 'KUMES_ID');
     }
}
