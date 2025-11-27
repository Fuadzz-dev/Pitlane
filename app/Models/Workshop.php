<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    protected $table = 'bengkel';
    protected $primaryKey = 'bengkel_id';  
    public $timestamps = false;
    
    protected $fillable = ['nama_bengkel', 'alamat', 'no_hp', 'jam_operasional', 'link_alamat'];

    public function mekanik()
    {
        return $this->hasMany(Mekanik::class, 'bengkel_id', 'bengkel_id');
    }
}