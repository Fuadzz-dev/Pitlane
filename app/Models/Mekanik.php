<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    protected $table = 'mekanik';
    protected $primaryKey = 'mekanik_id';
    public $timestamps = false;
    
    protected $fillable = ['nama_mekanik', 'no_hp', 'bengkel_id'];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class, 'bengkel_id', 'bengkel_id');
    }
}