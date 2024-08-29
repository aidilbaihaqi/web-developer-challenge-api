<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CPL extends Model
{
    use HasFactory;

    protected $primaryKey = 'kodecpl';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kodecpl',
        'deskripsi'
    ];
}
