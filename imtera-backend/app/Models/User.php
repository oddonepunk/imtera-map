<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Catbon\Carbon;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'login',
        'email',
        'password',
        'refresh_token',
        'refresh_token_expires_at'
    ];

    protected $hidden = [
        'password',
        'refresh_token'
    ];

    protected $casts = [
        'refresh_token_expires_at' => 'datetime'
    ];

    //jwt methods

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    //Help methods
    public function setRefreshToken(string $token): void {
        $this->update([
            'refresh_token' => $token,
            'refresh_token_expires_at' => Carbon::now()->allDays(7)
        ]);
    }

    public function clearRefreshToken(): void {
        $this->update([
            'refresh_token' => null,
            'refresh_token_expires_at' => null
        ]);
    }

    public function isRefreshTokenValid(string $token): bool {
        return $this->refresh_token === $token
            && $this->refresh_token_expires_at
            && $this->refresh_token_expires_at->isFuture();
    }
}
