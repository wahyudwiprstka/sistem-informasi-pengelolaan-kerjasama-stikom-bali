<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SDamian\Larasort\AutoSortable;

class Bidang extends Model
{
    use HasFactory;
    use AutoSortable;

    protected $table = 'bidang';

    protected $guarded = ['id'];

    protected $sortables = [
        'id',
        'nama_bidang',
        'klasifikasi',
        'pic',
    ];
}
