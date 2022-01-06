<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\RingtoneResource;
use App\Models\CategoryManage;
use App\Models\Ringtone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request){
        $domain=$_SERVER['SERVER_NAME'];
        $query = $request->input('query');
        $isFake = 0;
        if (checkBlockIp()){
            $isFake = 1;
            $ringtones= Ringtone::where('name', 'like', '%' . $query . '%')
                ->whereHas('categories', function ($q) use ($domain, $isFake) {
                    $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                        ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                        ->where('web_site',$domain)
                        ->where('turn_to_fake_cate','=', $isFake);
                })
                ->take(20)
                ->get();
            if($ringtones->isEmpty()){
                $ringtones=Ringtone::whereHas('categories', function ($q) use ($domain, $isFake) {
                    $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                        ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                        ->where('web_site',$domain)
                        ->where('turn_to_fake_cate','=', $isFake);
                })
                    ->take(20)
                    ->get();
            }
            $cate = CategoryManage::select('categories.*')
                ->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                ->where('web_site',$domain)
                ->where('categories.turn_to_fake_cate',$isFake)
                ->where('name', 'like', '%' . $query . '%')
                ->take(20)
                ->get();
            if($cate->isEmpty()){
                $cate = CategoryManage::select('categories.*')
                    ->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->take(20)
                    ->get();
            }
        }else{
            $ringtones= Ringtone::
            where('name', 'like', '%' . $query . '%')
                ->whereHas('categories', function ($q) use ($domain, $isFake) {
                    $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                        ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                        ->where('web_site',$domain)
                        ->where('turn_to_fake_cate','=', $isFake);
                })
                ->take(20)
                ->get();
            if($ringtones->isEmpty()){
                $ringtones=Ringtone::whereHas('categories', function ($q) use ($domain, $isFake) {
                    $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                        ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                        ->where('web_site',$domain)
                        ->where('turn_to_fake_cate','=', $isFake);
                })
                    ->take(20)
                    ->get();
            }
            $cate = CategoryManage::select('categories.*')
                ->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                ->where('web_site',$domain)
                ->where('categories.turn_to_fake_cate',$isFake)
                ->where('name', 'like', '%' . $query . '%')
                ->take(20)
                ->get();
            if($cate->isEmpty()){
                $cate = CategoryManage::select('categories.*')
                    ->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->take(20)
                    ->get();
            }
        }
        Log::error('Ring : '.$ringtones);
        Log::error('Cate: '.$cate);
        Log::error($request->all());
        return [
            'cates_result' =>  CategoryResource::collection($cate),
            'ringtones_result' => RingtoneResource::collection($ringtones)
        ];

    }
}
