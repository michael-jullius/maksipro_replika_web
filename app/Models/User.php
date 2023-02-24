<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'tb_user';

    public function proyek()
    {
        return $this->hasMany(Proyek::class, 'id_user');
    }

    public function AhsData()
    {
        return $this->hasMany(AhsData::class, 'id_user');
    }

    public function Bahan()
    {
        return $this->hasMany(Bahan::class, 'id_user');
    }

    public function AhsRealisasi()
    {
        return $this->hasMany(AhsRealisasi::class, 'id_user');
    }

    public function Rab()
    {
        return $this->hasMany(Rab::class, 'id_user');
    }

    public function ppn()
    {
        return $this->hasMany(Ppn::class, 'id_user');
    }

    public function QueryAhs()
    {
        return $this->hasMany(QueryAhs::class, 'id_user');
    }

    public function QueryAhsHarga()
    {
        return $this->hasMany(QueryAhsHarga::class, 'id_user');
    }

    public function QueryAhsPake()
    {
        return $this->hasMany(QueryAhsPake::class, 'id_user');
    }

    public function QueryHargaSatuanAlat()
    {
        return $this->hasMany(QueryHargaSatuanAlat::class, 'id_user');
    }

    public function QueryHargaSatuanBahan()
    {
        return $this->hasMany(QueryHargaSatuanBahan::class, 'id_user');
    }

    public function QueryHargaSatuanLain()
    {
        return $this->hasMany(QueryHargaSatuanLain::class, 'id_user');
    }

    public function QueryHargaSatuanUpah()
    {
        return $this->hasMany(QueryHargaSatuanLain::class, 'id_user');
    }

    public function QueryRab()
    {
        return $this->hasMany(QueryRab::class, 'id_user');
    }

    public function QueryRekapTotal()
    {
        return $this->hasMany(QueryRekapTotal::class, 'id_user');
    }
}
