<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Pengurus extends Authenticatable
{
    protected $primaryKey = 'Nim';
    public $incrementing = false;
    use HasFactory;
    protected $fillable = [
        'Nim',
        'Nama',
        'organisasi_id',
        'divisi_id',
        'jabatan_id',
        'program_studi_id',
        'Password',
        'Status',
        'modified_by',
    ];

    public function organisasi(){
        return $this->belongsTo(Organisasi::class);
    }

    public function prodi(){
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
    
    public function jabatan(){
        return $this->belongsTo(Jabatan::class,'jabatan_id');
    }

    public function divisi(){
        return $this->belongsTo(Divisi::class,'divisi_id');
    }

    public function transaksiPenilaians(){
        return $this->hasMany(TransaksiPenilaian::class,'pengurus_id', 'Nim');
    }
}