<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_organisasi',
        'status',
        'created_by',
        'modified_by',        
    ];

    public function penguruses(){
        return $this->hasMany(Pengurus::class);
    }

    public function divisis(){
        return $this->hasMany(Divisi::class);
    }
}