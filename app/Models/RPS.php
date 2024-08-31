<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPS extends Model
{
    use HasFactory;

    protected $primaryKey = 'kodeRPS';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kodeRPS',
        'judul',
        'kodemk',
        'deskripsi',
        'semester'
    ];
}
