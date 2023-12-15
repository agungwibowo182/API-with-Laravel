<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;
    protected $table = 'nasabah';
    protected $fillable = ['name', 'email','tanggal_lahir','jenis_kartu','nomor_kartu','cabang',
    'saldo','nomor_rekening'];
}
