<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'referral_code',
        'referred_by',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'created_by');
    }

    public function assignedOrders()
    {
        return $this->hasMany(Order::class, 'assigned_to');
    }

    public function referralRewards()
    {
        return $this->hasMany(Referral::class, 'referrer_id');
    }

    public function referralWithdrawals()
    {
        return $this->hasMany(ReferralWithdrawal::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'to');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'created_by');
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class, 'requested_by');
    }

    // Helper methods
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function isManager()
    {
        return $this->role === 'manager';
    }

    public function isWriter()
    {
        return $this->role === 'writer';
    }

    public function isClient()
    {
        return $this->role === 'client';
    }

    public function isActive()
    {
        return $this->status === 'active';
    }
}
