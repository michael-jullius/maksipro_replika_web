<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputMaterial extends Model
{
    use HasFactory;
    protected $table = "tb_input_material";
    
    protected $fillable = ['id_user','tanggal_transaksi', 'no_bukti', 'nama_supplier', 'keterangan', 'kode_material', 'nama_material', 'satuan', 'harga_satuan', 'jumlah_masuk', 'nama_pekerjaan'];

}
