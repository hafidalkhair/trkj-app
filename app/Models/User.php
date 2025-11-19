<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser; // <--- Tambahan Wajib 1
use Filament\Panel; // <--- Tambahan Wajib 2

class User extends Authenticatable implements FilamentUser // <--- Tambahan Wajib 3
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

    // --- FUNCTION UTAMA UNTUK MENGATASI 403 FORBIDDEN ---
    public function canAccessPanel(Panel $panel): bool
    {
        // CARA 1: Izinkan SEMUA user login (Hanya pakai ini untuk testing awal!)
        return true;

        // CARA 2 (LEBIH AMAN): Hanya izinkan email tertentu
        // return $this->email === 'emailadminanda@gmail.com';

        // CARA 3: Jika user punya email domain kantor
        // return str_ends_with($this->email, '@perusahaan.com');
    }
}
