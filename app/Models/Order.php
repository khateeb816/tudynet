<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'expiry_date',
        'words',
        'description',
        'subject_id',
        'total_amount',
        'attachments',
        'half_payment_image',
        'full_payment_image',
        'half_file',
        'full_file',
        'status',
        'created_by',
        'assigned_to',
        'is_visible_to_client',
        'half_file_visible',
        'full_file_visible',
    ];

    protected $casts = [
        'attachments' => 'array',
        'expiry_date' => 'date',
        'is_visible_to_client' => 'boolean',
        'half_file_visible' => 'boolean',
        'full_file_visible' => 'boolean',
        'total_amount' => 'decimal:2',
    ];

    // Relationships
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedWriter()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function statusHistory()
    {
        return $this->hasMany(OrderStatus::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}
