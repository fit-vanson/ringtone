<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\WallpaperResource;
use App\Models\BlockIp;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryManage;
use App\Models\SiteManage;


class CategoryController extends Controller
{
    public function index()
    {

        $domain=$_SERVER['SERVER_NAME'];

        if(checkBlockIp()){
            $data = SiteManage::with('category')
                ->leftJoin('categories_has_site', 'categories_has_site.site_id', '=', 'sites.id')
                ->leftJoin('categories', 'categories.id', '=', 'categories_has_site.category_id')
                ->where('web_site',$domain)
                ->where('categories.turn_to_fake_cate',1)
                ->get();
            return CategoryResource::collection($data);

        } else{
            $data = SiteManage::with('category')
                ->leftJoin('categories_has_site', 'categories_has_site.site_id', '=', 'sites.id')
                ->leftJoin('categories', 'categories.id', '=', 'categories_has_site.category_id')
                ->where('web_site',$domain)
                ->where('categories.turn_to_fake_cate',0)
                ->get();
            return CategoryResource::collection($data);
        }
    }
    public function getPopulared()
    {
        $domain=$_SERVER['SERVER_NAME'];
        if (checkBlockIp()){
            $data = SiteManage::with('category')
                ->leftJoin('categories_has_site', 'categories_has_site.site_id', '=', 'sites.id')
                ->leftJoin('categories', 'categories.id', '=', 'categories_has_site.category_id')
                ->where('web_site',$domain)
                ->where('categories.turn_to_fake_cate',1)
                ->where('view_count','>=',10)
                ->orderBy('view_count','desc')->get();
        }else{
            $data = SiteManage::with('category')
                ->leftJoin('categories_has_site', 'categories_has_site.site_id', '=', 'sites.id')
                ->leftJoin('categories', 'categories.id', '=', 'categories_has_site.category_id')
                ->where('web_site',$domain)
                ->where('categories.turn_to_fake_cate',0)
                ->where('view_count','>=',10)
                ->orderBy('view_count','desc')->get();
        }
        return CategoryResource::collection($data);
    }
}
