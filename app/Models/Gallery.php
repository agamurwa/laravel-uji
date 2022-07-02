<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Gallery extends Model
{
    // use HasFactory;
    use softDeletes;

    protected $primaryKey = 'id';
    public $table = "galleries";

    protected $fillable = [
        'doctors_id','image'
    ];

    protected $hidden = [

    ];

    public function doctor(){
        return $this->belongsTo(DataDokter::class, 'doctors_id', 'id');
    }

}
