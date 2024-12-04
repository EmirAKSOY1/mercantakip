<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'ip', 
        'user_id', 
        'action', 
        'date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
