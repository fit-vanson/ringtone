<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteManage extends Model
{
    use HasFactory;
    protected $table = 'sites';
    protected $fillable = [];

    public function category()
    {
        return $this->belongsToMany(CategoryManage::class, 'categories_has_site', 'site_id', 'category_id');
    }

//    public function getCategoryCount(){
//        return $this->category()->count();
//    }
//
//    public function getCategory()
//    {
//        return $this->belongsToMany(CategoryManage::class)->wherePivot('site_id', '=', 2);
//    }

//
//    public function api_key()
//    {
//        return $this->belongsTo(ApiKeys::class,'apikey_id');
//    }

    public function blockIps()
    {
        return $this->belongsToMany(BlockIP::class, 'block_ips_has_site', 'sites_id', 'blockIps_id');
    }

    public function feature_images()
    {
        return $this->hasMany(FeatureImage::class, 'site_id');
    }


}
