<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'account_id',
        'transfer_id',
        'type',
        'amount',
        'currency',
        'description',
        'occurred_at',
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }
}
