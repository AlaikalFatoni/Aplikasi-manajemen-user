<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal (mass assignment)
    protected $fillable = [
        'nama_pelanggan',
        'username',
        'password',
        'alamat',
        'email',
        'whatsapp',
        'poin_member',
        'kategori_member',
    ];

    // Kolom yang harus disembunyikan (terutama password)
    protected $hidden = [
        'password',
    ];
    const CATEGORY_RULES = [
        'Gold' => 5000,   // Di atas 5000 poin
        'Silver' => 1000, // Di atas 1000 poin
        'Bronze' => 0,    // Default, di atas 0 poin
    ];
    public function setPoinMemberAttribute($value)
    {
        $this->attributes['poin_member'] = $value;

        // Tentukan kategori baru berdasarkan nilai poin
        $kategoriBaru = 'Bronze';
        if ($value >= self::CATEGORY_RULES['Gold']) {
            $kategoriBaru = 'Gold';
        } elseif ($value >= self::CATEGORY_RULES['Silver']) {
            $kategoriBaru = 'Silver';
        }
        
        // Simpan kategori baru
        $this->attributes['kategori_member'] = $kategoriBaru;
    }
}

