<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Schedule extends Model
{
    use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "doctors_schedules";

    protected $fillable = [
        'doctors_id','hari_praktek','jam_praktek',
    ];

    protected $hidden = [

    ];

    public function doctor(){
        return $this->belongsTo(DataDokter::class, 'doctors_id', 'id');
    }

    public function schedule(){
        return $this->belongsTo(Schedule::class, 'doctors_id', 'id');
    }

    public function galery(){
        return $this->belongsTo(Gallery::class, 'doctors_id', 'doctors_id');
    }
}