<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Pendaftaran extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "pendaftaran";

    protected $fillable = [
        'id_pasien','nama_pasien','doctors_id', 'tgl_pendaftaran'
    ];

    protected $hidden = [

    ];

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
