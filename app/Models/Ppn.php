<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ppn extends Model
{
    use HasFactory;

    protected $table ='tb_ppn';

    public function Proyek()
    {
        return $this->BelongsTo(Proyek::class, 'id_proyek');
    }

    public function User()
    {
        return $this->BelongsTo(User::class, 'id_user');
    }
}
