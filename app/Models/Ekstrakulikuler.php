<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    protected $table = 'ekstrakurikuler';

    protected $primaryKey = 'id_ekskul';

    protected $fillable = [
        'nama_ekskul',
        'pembina',
        'jadwal_latihan',
        'deskripsi',
        'gambar',
    ];
}