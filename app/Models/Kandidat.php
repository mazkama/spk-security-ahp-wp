<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;
    protected $table = 'kandidat';
    protected $fillable = ['nama', 'periode_id'];

    public function periode()
    {
        return $this->belongsTo(Periode::class);
    }
}
