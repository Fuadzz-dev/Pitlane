<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mekanik extends Model
{
    protected $table = 'mekanik';
    protected $fillable = ['nama_mekanik', 'no_hp', 'bengkel_id'];

    public function workshop()
    {
        return $this->belongsTo(Workshop::class);
    }
}
git