<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Guru extends Model
{
    protected $table = 'guru';

    protected $primaryKey = 'id_guru';

    protected $fillable = [
        'nama_guru',
        'nip',
        'mapel',
        'foto',
        'slug',
    ];

    protected static function booted(): void
    {
        static::creating(function ($guru) {
            if (empty($guru->slug)) {
                $guru->slug = Str::slug($guru->nama_guru);
            }
        });

        static::updating(function ($guru) {
            if ($guru->isDirty('nama_guru')) {
                $guru->slug = Str::slug($guru->nama_guru);
            }
        });
    }
}
