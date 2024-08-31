<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasisEvaluasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'kodeEvaluasi';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kodeEvaluasi',
        'kodeRPS',
        'namaEvaluasi',
        'bobotEvaluasi',
        'deskripsi'
    ];

}
