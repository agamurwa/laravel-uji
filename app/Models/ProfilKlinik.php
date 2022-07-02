<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class ProfilKlinik extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "profil_klinik";

    protected $fillable = [
        'nama_klinik','slogan','jasa_dokter'
    ];

    protected $hidden = [

    ];
}
