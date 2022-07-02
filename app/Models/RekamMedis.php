<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class RekamMedis extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "medical_records";

    protected $fillable = [
        // 'nrm','nama_pasien','doctors_id','keluhan','anamnesis','pemeriksaan_fisik','diagnosa'
        'id_pasien','nama_pasien','doctors_id','nama_dokter','keluhan','anamnesis','pemeriksaan_fisik',
        'diagnosa','id_obat','jumlah_obat','aturan_minum','tgl_periksa'
    ];

    protected $hidden = [

    ];

    public function user(){
        return $this->belongsTo(User::class, 'doctors_id', 'id');
    }

    public function doctors(){
        return $this->hasMany(DataDokter::class, 'id', 'doctors_id');
    }

    public function doctors_schedules(){
        return $this->hasMany(Schedule::class, 'doctors_id', 'doctors_id');
    }

    public function patients(){
        return $this->hasMany(DataPasien::class, 'id_pasien', 'id_pasien');
    }
}
