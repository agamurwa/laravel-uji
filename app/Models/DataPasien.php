<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class DataPasien extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "patients";

    protected $fillable = [
        'id_pasien','nama_pasien','tempat_lahir', 'tgl_lahir', 'alamat', 'jns_kelamin', 'no_telp'
    ];

    protected $hidden = [

    ];
}
