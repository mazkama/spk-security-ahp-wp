<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilWp extends Model
{
    use HasFactory;
    protected $table = 'hasil_wp';
    protected $fillable = [
        'kandidat_id', 'nilai_s', 'nilai_v', 'ranking'
    ];

    public function kandidat()
    {
        return $this->belongsTo(Kandidat::class);
    }
}
