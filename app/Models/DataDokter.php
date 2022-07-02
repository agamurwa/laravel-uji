<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class DataDokter extends Model
{
    use HasFactory;
    use softDeletes; 
    
    public $table = "doctors";

    protected $fillable = [
        'id', 'nama_dokter', 'no_telp', 'alamat', 'tempat_lahir', 'tgl_lahir', 'bidang', 
        'tentang_dokter', 'riwayat_pendidikan','riwayat_pekerjaan', 'organisasi'
    ];

    protected $hidden = [

    ];

    public function galleries(){
        return $this->hasMany(Gallery::class, 'doctors_id', 'id');
    }

    public function doctors_schedules(){
        return $this->hasMany(Schedule::class, 'doctors_id', 'id');
    }

}
