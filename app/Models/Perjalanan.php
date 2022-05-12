<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perjalanan extends Model
{
    use HasFactory;

    protected $table = 'perjalanans';

    protected $fillable = [
        'user_id',
        'tanggal',
        'waktu',
        'suhu',
        'lokasi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
