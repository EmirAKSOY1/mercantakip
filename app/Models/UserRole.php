<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    
    protected $table = 'role_user';

    protected $fillable = [
        'user_id',
        'role_id',
        'entegre_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function entegre()
    {
        return $this->belongsTo(related: Entegre::class);
    }
}
