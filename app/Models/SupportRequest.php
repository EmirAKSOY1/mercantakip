<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportRequest extends Model
{
    protected $fillable = [
        'title',
        'description',
        'images',
        'status',
        'requester_id',
        'responder_id',
        'response',
    ];

    protected $casts = [
        'images' => 'array', // JSON formatında birden fazla resim için diziye dönüştürülmesi
    ];

    // Talep oluşturan kullanıcı ilişkisi
    public function requester()
    {
        return $this->belongsTo(User::class, 'requester_id');
    }

    // Cevap veren kullanıcı ilişkisi
    public function responder()
    {
        return $this->belongsTo(User::class, 'responder_id');
    }
}
