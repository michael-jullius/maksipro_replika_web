<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AhsData extends Model
{
    use HasFactory;

    protected $table ='tb_ahs_data';

    protected $fillable = ['id_proyek', 'id_user', 'jenis_pekerjaan', 'kode', 'analisa_pekerjaan', 'satuan'];

    public function proyek()
    {
        return $this->BelongsTo(Proyek::class, 'id_proyek');
    }

    public function user()
    {
        return $this->BelongsTo(User::class, 'id_user');
    }
}
