<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReferralWithdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'requested_at',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'requested_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
