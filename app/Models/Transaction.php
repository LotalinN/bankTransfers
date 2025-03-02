<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_account',
        'to_account',
        'amount',
        'comment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromAccount()
    {
        return $this->belongsTo(BankAccount::class, 'from_account');
    }

    public function toAccount()
    {
        return $this->belongsTo(BankAccount::class, 'to_account');
    }
}
