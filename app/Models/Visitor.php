<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'device_id'
    ];

    public function ringtones(){
        return $this->belongsToMany(Ringtone::class,'visitor_favorites');
    }

}
