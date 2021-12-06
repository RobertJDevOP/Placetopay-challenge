<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected string $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $appends = [
        'date_formatted',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'enabled_at',
    ];

    public function markAsEnabled(): void
    {
        $this->enabled_at = now();
        $this->save();
    }

    public function isEnabled(): bool
    {
        return null !== $this->enabled_at;
    }

    public function markAsDisabled(): void
    {
        $this->enabled_at = null;
        $this->save();
    }

    public function getDateFormattedAttribute(): string
    {
        return date('d-m-Y', strtotime($this->attributes['created_at']));
    }

    public function getStatusAttribute(): string
    {
        return (is_null($this->attributes['enabled_at'])) ? 'disabled' : 'enabled';
    }
}
