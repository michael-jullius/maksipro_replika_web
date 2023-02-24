<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhsRealisasi extends Model
{
    use HasFactory;

    protected $table ='tb_ahs_realisasi';

    protected $fillable = ['id_user','id_proyek','kelompok', 'kode', 'keterangan', 'id_bahan', 'koefisien'];

    public function proyek()
    {
        return $this->BelongsTo(Proyek::class, 'id_proyek');
    }

    public function user()
    {
        return $this->BelongsTo(User::class, 'id_user');
    }
}