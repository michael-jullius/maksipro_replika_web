<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryHargaSatuanBahan extends Model
{
    use HasFactory;
    protected $table ='tb_query_harga_satuan_bahan';

    public function proyek()
    {
        return $this->BelongsTo(Proyek::class, 'id_proyek');
    }

    public function user()
    {
        return $this->BelongsTo(User::class, 'id_user');
    }
}
