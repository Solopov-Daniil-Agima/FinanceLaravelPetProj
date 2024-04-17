<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBalance extends Model
{
    use HasFactory;

    protected $table = 'user_balance';

    protected $fillable = [
        'balance',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
