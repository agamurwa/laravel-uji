<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class AddRekamMedis extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "medical_records";

    protected $fillable = [
        'id_pasien','nama_pasien','doctors_id','nama_dokter','keluhan','anamnesis','pemeriksaan_fisik',
        'diagnosa','id_obat','jumlah_obat','aturan_minum','tgl_periksa'
    ];

    protected $hidden = [

    ];

    public function patient(){
        return $this->belongsTo(DataPasien::class, 'id_pasien', 'id_pasien');
    }

    public function user(){
        return $this->belongsTo(User::class, 'doctors_id', 'id');
    }

    public function obat(){
        return $this->belongsTo(Obat::class, 'id', 'id_obat');
    }
}
