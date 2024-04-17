<?php

namespace App\Models\Transaction;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMinus extends Model
{
    use HasFactory;

    protected $table = 'transactions_minus';

    protected $fillable = ['user_id', 'sum', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
