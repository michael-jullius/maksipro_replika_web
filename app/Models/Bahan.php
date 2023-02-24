<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table ='tb_bahan';

    protected $fillable = ['id_proyek', 'id_user','kelompok', 'sub_kelompok', 'kode', 'nama', 'satuan', 'harga', 'keterangan'];

    public function proyek()
    {
        return $this->BelongsTo(Proyek::class, 'id_proyek');
    }

    public function user()
    {
        return $this->BelongsTo(User::class, 'id_user');
    }
}
