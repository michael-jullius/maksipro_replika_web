<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueryRab extends Model
{
    use HasFactory;
    protected $table ='tb_query_rab';

    public function proyek()
    {
        return $this->BelongsTo(Proyek::class, 'id_proyek');
    }

    public function user()
    {
        return $this->BelongsTo(User::class, 'id_user');
    }
}
