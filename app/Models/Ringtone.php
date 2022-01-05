<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ringtone extends Model
{
    use HasFactory;

    const FEATURE_ON = 1;
    const FEATURE_OFF = 0;
    protected $table='ringtones';
    protected $guarded=[];
    public static function getFeatured()
    {
        return [
            self::FEATURE_ON => 'on',
            self::FEATURE_OFF => 'off'
        ];
    }
    public function FeaturedName(){
        $listFeatured = self::getFeatured();
        return $listFeatured[$this->feature] ?? null;
    }
    public function categories(){
        return $this->belongsToMany(CategoryManage::class, 'category_has_ringtones', 'ringtone_id', 'category_id');
    }

}
