<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\FeatureWallpaperResource;

use App\Http\Resources\RingtoneResource;
use App\Models\Category;
use App\Models\CategoryManage;
use App\Models\ListIp;
use App\Models\LoadFeature;
use App\Models\Ringtone;
use App\Models\SiteManage;
use App\Models\Visitor;
use App\Models\VisitorFavorite;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;


class RingtoneController extends Controller
{
    public function show($id,$device_id)
    {
        $ringtone = Ringtone::findOrFail($id);
        $ringtone->increment('view_count');
        $visitorFavorite = VisitorFavorite::where([
            'ringtone_id' => $id,
            'visitor_id' => Visitor::where('device_id', $device_id)->value('id')])->first();
        if($visitorFavorite){
            return response()->json([
                'categories' =>
                    CategoryResource::collection($ringtone->categories),
                'id' => $ringtone->id,
                'name' => $ringtone->name,
                'thumbnail_image' => asset('storage/ringtones/'.$ringtone->thumbnail_image),
                'ringtone_file'=>asset('storage/ringtones/'.$ringtone->ringtone_file),
                'like_count' => $ringtone->like_count,
                'views' => $ringtone->view_count,
                'feature' => $ringtone->feature,
                'created_at' => $ringtone->created_at->format('d/m/Y'),
            ]);
        }else{
            return response()->json([
                'liked' => 0,
                'categories' =>
                    CategoryResource::collection($ringtone->categories),
                'id' => $ringtone->id,
                'name' => $ringtone->name,
                'thumbnail_image' => asset('storage/ringtones/'.$ringtone->thumbnail_image),
                'ringtone_file'=>asset('storage/ringtones/'.$ringtone->ringtone_file),
                'like_count' => $ringtone->like_count,
                'views' => $ringtone->view_count,
                'feature' => $ringtone->feature,
                'created_at' => $ringtone->created_at->format('d/m/Y'),
            ]);
        }
    }

    public function getFeatured()
    {
        $domain=$_SERVER['SERVER_NAME'];
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]))
            $ipaddress= $_SERVER["HTTP_CF_CONNECTING_IP"];
        else
            $ipaddress = 'UNKNOWN';
        $listIp=ListIp::where('ip_address',$ipaddress)->first();

        $site=SiteManage::where('web_site',$domain)->first();

        if(!$listIp){
            ListIp::create([
                'ip_address'=>$ipaddress
            ]);
        }else{
            $listIp=ListIp::where('ip_address',get_ip())->first();
            if(!$listIp){
                ListIp::create([
                    'ip_address'=>get_ip()
                ]);
            }
        }

        $load_feature=$site->load_home_features;
        dd($load_feature);
        $isFake = 0;
        if (checkBlockIp()) {
            $isFake = 1;
            if($load_feature ==0){
                $data = CategoryManage::leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->select('categories.*')
                    ->inRandomOrder()->get();
            }elseif($load_feature ==1){
                $data = CategoryManage::leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->select('categories.*')
                    ->orderBy('order', 'desc')->get();

            }elseif($load_feature ==2){
                $data = CategoryManage::leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->select('categories.*')
                    ->orderBy('view_count', 'desc')->get();
            }elseif($load_feature ==3){
                $data = CategoryManage::leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->select('categories.*')
                    ->orderBy('view_count', 'desc')->get();
            }
        } else {
            if($load_feature ==0){
                $data = CategoryManage::leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->select('categories.*')
                    ->inRandomOrder()->get();
            }elseif($load_feature ==1){
                $data = CategoryManage::leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->select('categories.*')
                    ->orderBy('order', 'desc')->get();

            }elseif($load_feature ==2){
                $data = CategoryManage::leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->select('categories.*')
                    ->orderBy('view_count', 'desc')->get();
            }elseif($load_feature ==3){
                $data = CategoryManage::leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('categories.turn_to_fake_cate',$isFake)
                    ->select('categories.*')
                    ->orderBy('view_count', 'desc')->get();
            }
        }
        $getResource= CategoryResource::collection($data);
        return response()->json([
            'message'=>'save ip successs',
            'ad_switch'=>$site->ad_switch,
            'data'=>$getResource,
        ]);

    }
    public function getPopulared($deviceId)
    {
        $domain=$_SERVER['SERVER_NAME'];
        $isFake = checkBlockIp()?1:0;

        $data = Ringtone::where('like_count','>=',1)
            ->orderBy('like_count','desc')
            ->whereHas('categories', function ($q) use ($domain, $isFake) {
                $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('turn_to_fake_cate','=', $isFake);
            })
            ->paginate(70);
        $ringtones = $this->checkLikedToRingtones($deviceId, $data);
        $getResource=RingtoneResource::collection($ringtones);
        return $getResource;
    }

    public function getNewest($deviceId)
    {
        $domain=$_SERVER['SERVER_NAME'];
        if (checkBlockIp()){
            $data = Ringtone::orderBy('created_at','desc')
                ->whereHas('categories', function ($q) use ($domain) {
                    $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                        ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                        ->where('web_site',$domain)
                        ->where('turn_to_fake_cate','=', 1);
                })
                ->paginate(70);
        }else {
            $data = Ringtone::orderBy('created_at','desc')
                ->whereHas('categories', function ($q) use ($domain) {
                    $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                        ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                        ->where('web_site',$domain)
                        ->where('turn_to_fake_cate','=', 0);
                })
                ->paginate(70);
        }
        $ringtones = $this->checkLikedToRingtones($deviceId, $data);
        $getResource=RingtoneResource::collection($ringtones);
        return $getResource;
    }


    public function getPremium(){
        $domain=$_SERVER['SERVER_NAME'];
        if (checkBlockIp()){
            $data = Ringtone::where('set_as_premium','=',1)
                ->orderBy('created_at','desc')
                ->whereHas('categories', function ($q) use ($domain) {
                    $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                        ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                        ->where('web_site',$domain)
                        ->where('turn_to_fake_cate','=', 1);
                })
                ->paginate(70);
        }else{
            $data = Ringtone::where('set_as_premium','=',1)
                ->orderBy('created_at','desc')
                ->whereHas('categories', function ($q) use ($domain) {
                    $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                        ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                        ->where('web_site',$domain)
                        ->where('turn_to_fake_cate','=', 0);
                })
                ->paginate(70);
        }
        $getResource=RingtoneResource::collection($data);
        return $getResource;
    }

    public function getMostDownload($deviceId){
        $domain=$_SERVER['SERVER_NAME'];
        $isFake = checkBlockIp()?1:0;
        $data = Ringtone::orderBy('downloads','desc')
            ->whereHas('categories', function ($q) use ($domain, $isFake) {
                $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                    ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                    ->where('web_site',$domain)
                    ->where('turn_to_fake_cate','=', $isFake);
            })
            ->paginate(70);
        $ringtones = $this->checkLikedToRingtones($deviceId, $data);
        return RingtoneResource::collection($ringtones);
    }

    public function getRingtonesByCate($id, $deviceId)
    {
        try{
            $domain=$_SERVER['SERVER_NAME'];
            $sort = SiteManage::where('web_site',$domain)->first();
            switch ($sort->load_wallpapers){
                case 0:
                    $data = Ringtone::whereHas('categories', function ($q) use ($id, $domain) {
                            $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                                ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                                ->where('web_site',$domain)
                                ->where('categories.id',$id);
                        })
                        ->paginate(70);
                    break;
    //                $data = Category::findOrFail($id)
    //                    ->ringtones()
    //                    ->inRandomOrder()
    //                    ->paginate(70);
                case 1:

                    $data = Ringtone::orderBy('like_count','desc')
                        ->whereHas('categories', function ($q) use ($id, $domain) {
                            $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                                ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                                ->where('web_site',$domain)
                                ->where('categories.id',$id);
                        })
                        ->paginate(70);

    //                $data = Category::findOrFail($id)
    //                    ->ringtones()
    //                    ->orderBy('like_count', 'desc')
    //                    ->paginate(70);
                    break;
                case 2:
                    $data = Ringtone::orderBy('view_count','desc')
                        ->whereHas('categories', function ($q) use ($id, $domain) {
                            $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                                ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                                ->where('web_site',$domain)
                                ->where('categories.id',$id);
                        })
                        ->paginate(70);
    //                $data = Category::findOrFail($id)
    //                    ->ringtones()
    //                    ->orderBy('view_count', 'desc')
    //                    ->paginate(70);
                    break;
                case 3:
                    $data = Ringtone::orderBy('feature','desc')
                        ->whereHas('categories', function ($q) use ($id, $domain) {
                            $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                                ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                                ->where('web_site',$domain)
                                ->where('categories.id',$id);
                        })
                        ->paginate(70);
    //                $data = Category::findOrFail($id)
    //                    ->ringtones()
    //                    ->where('feature', 1)
    //                    ->paginate(70);
                    break;
                case 4:
                    $data = Ringtone::orderBy('name','asc')
                        ->whereHas('categories', function ($q) use ($id, $domain) {
                            $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                                ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                                ->where('web_site',$domain)
                                ->where('categories.id',$id);
                        })
                        ->paginate(70);
    //                $data = Category::findOrFail($id)
    //                    ->ringtones()
    //                    ->orderBy('name', 'asc')
    //                    ->paginate(70);
                    break;
                default :
                    $data = Ringtone::whereHas('categories', function ($q) use ($id, $domain) {
                            $q->leftJoin('categories_has_site', 'categories_has_site.category_id', '=', 'categories.id')
                                ->leftJoin('sites', 'sites.id', '=', 'categories_has_site.site_id')
                                ->where('web_site',$domain)
                                ->where('categories.id',$id);
                        })
                        ->paginate(70);
    //                $data = Category::findOrFail($id)
    //                    ->ringtones()
    //                    ->paginate(70);
                }
            $ringtones = $this->checkLikedToRingtones($deviceId, $data);
            $getResource = RingtoneResource::collection($ringtones);
            return $getResource;
        }catch (\Exception $e){
            return response()->json(['warning' => ['This Category is not exist']], 200);
        }

    }

    private function checkLikedToRingtones($deviceId, $data){
        $visitorId = Visitor::where('device_id','=',$deviceId)->first('id');
        $visitorFavorites = array();
        if($visitorId){
            $visitorFavorites = VisitorFavorite::where('visitor_id', $visitorId->id)->get('ringtone_id');
        }
        foreach ($data as $i){
            $i->liked = 0;
            foreach ($visitorFavorites as $favorite){
                if($favorite->ringtone_id==$i->id){
                    $i->liked = 1;
                }
            }
        }
        return $data;
    }
}
