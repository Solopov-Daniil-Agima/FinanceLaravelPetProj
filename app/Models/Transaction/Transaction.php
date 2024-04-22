<?php

namespace App\Models\Transaction;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction_table';

    protected $fillable = ['user_id', 'transaction_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
