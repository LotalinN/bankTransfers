<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_id',
        'account_number',
        'money_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function fromTransactions()
    {
        return $this->hasMany(Transaction::class, 'from_account');
    }

    public function toTransactions()
    {
        return $this->hasMany(Transaction::class, 'to_account');
    }
}

