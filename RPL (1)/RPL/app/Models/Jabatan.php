<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_jabatan',
        'status',
        'created_by',
        'modified_by',      
        'divisi_id',
    ];

    public function divisis(){
        return $this->belongsToMany(Divisi::class, 'divisi_jabatan', 'jabatan_id', 'divisi_id');
    }
    public function penguruses(){
        return $this->hasMany(Pengurus::class);
    }
}