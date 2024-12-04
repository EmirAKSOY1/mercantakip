<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EndkonAriza extends Model
{
        
        protected $table = 'endkon_ariza';

        protected $fillable = [
            'description',
            'date',
            'kumes_id'
        ];
    
        public function kumes()
        {
            return $this->belongsTo(Kumes::class, 'kumes_id');
        }
}
