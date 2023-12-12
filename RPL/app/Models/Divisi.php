<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_divisi',
        'status',
        'created_by',
        'modified_by',
        'organisasi_id',        
    ];

    public function organisasi(){
        return $this->belongsTo(Organisasi::class);
    }

    public function jabatans(){
        return $this->hasMany(Jabatan::class);
    }

    public function penguruses(){
        return $this->hasMany(Pengurus::class);
    }
}