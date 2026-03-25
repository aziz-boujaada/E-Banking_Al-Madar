<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'number',
        'type',
        'status',
        'balance',
        'overdraft_limit',
        'interest_rate',
        'daily_limit',
        'blocked_reason',
        'owner_id',
        'guardian_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function guardian()
    {
        return $this->belongsTo(User::class, 'guardian_id');
    }

    public function coOwners()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('accepted_closure')
            ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function outgoingTransfers()
    {
        return $this->hasMany(Transfer::class, 'source_account_id');
    }

    public function incomingTransfers()
    {
        return $this->hasMany(Transfer::class, 'destination_account_id');
    }
}
