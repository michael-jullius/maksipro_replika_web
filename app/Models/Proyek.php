<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;
    protected $table ='tb_proyek';

    public function user()
    {
    	return $this->BelongsTo(User::class, 'id_user');
    }

    public function AhsData()
    {
        return $this->hasMany(AhsData::class, 'id_proyek');
    }

    public function Bahan()
    {
        return $this->hasMany(Bahan::class, 'id_proyek');
    }

    public function AhsRealisasi()
    {
        return $this->hasMany(AhsRealisasi::class, 'id_proyek');
    }

    public function Rab()
    {
        return $this->hasMany(Rab::class, 'id_proyek');
    }

    public function Ppn()
    {
        return $this->hasMany(Ppn::class, 'id_proyek');
    }

    public function QueryAhs()
    {
        return $this->hasMany(QueryAhs::class, 'id_proyek');
    }

    public function QueryAhsHarga()
    {
        return $this->hasMany(QueryAhsHarga::class, 'id_proyek');
    }

    public function QueryAhsPake()
    {
        return $this->hasMany(QueryAhsPake::class, 'id_proyek');
    }

    public function QueryHargaSatuanAlat()
    {
        return $this->hasMany(QueryHargaSatuanAlat::class, 'id_proyek');
    }

    public function QueryHargaSatuanBahan()
    {
        return $this->hasMany(QueryHargaSatuanBahan::class, 'id_proyek');
    }

    public function QueryHargaSatuanLain()
    {
        return $this->hasMany(QueryHargaSatuanLain::class, 'id_proyek');
    }

    public function QueryHargaSatuanUpah()
    {
        return $this->hasMany(QueryHargaSatuanLain::class, 'id_proyek');
    }

    public function QueryRab()
    {
        return $this->hasMany(QueryRab::class, 'id_proyek');
    }

    public function QueryRekapTotal()
    {
        return $this->hasMany(QueryRekapTotal::class, 'id_proyek');
    }
}
