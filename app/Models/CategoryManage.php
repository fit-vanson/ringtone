<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryManage extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [];


    public function site()
    {
        return $this->belongsToMany(SiteManage::class, 'categories_has_site', 'category_id', 'site_id');
    }
    public function ringtone(){
        return $this->belongsToMany(Ringtone::class,'category_has_ringtones','category_id','ringtone_id');
    }


    public static function booted()
    {
        static::deleting(function ($category) {
            $ringtone = $category->ringtone()->get();
//            dd($walpapers->pluck('id')->toArray());
            $sites = $category->site()->get();

            if ($ringtone->isNotEmpty()) {
                $category->wallpaper()->detach();
                $defaultCategory = static::find(1);
                $defaultCategory->ringtone()->sync($ringtone->pluck('id')->toArray(),false);
            }
            if ($sites->isNotEmpty()) {
                $category->site()->detach();
                $defaultCategory = static::find(1);
                $defaultCategory->site()->sync($sites->pluck('id')->toArray(),false);
            }
        });
    }
}
