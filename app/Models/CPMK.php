<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPMK extends Model
{
    use HasFactory;

    protected $primaryKey = 'kodecpmk';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kodecpmk',
        'kodecpl',
        'deskripsi'
    ];
}
