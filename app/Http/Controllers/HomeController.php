<?php

namespace App\Http\Controllers;

use App\Models\FeatureImage;


use App\Models\Ringtone;
use App\Models\SiteManage;
use App\Models\User;
use Carbon\Carbon;
use Cloudflare\API\Adapter\Guzzle;
use Cloudflare\API\Auth\APIKey;
use Cloudflare\API\Endpoints\DNS;
use Cloudflare\API\Endpoints\DNSAnalytics;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use ImageOrientationFix\ImageOrientationFixer;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Monolog\Logger;
//use Spatie\Analytics\Analytics;
//use Analytics;

use Spatie\Permission\Models\Role;
use Spatie\Analytics\Period;
use Spatie\Analytics\Analytics;
use Spatie\Analytics\AnalyticsFacade;
//use Wappr\Cloudflare\AnalyticsClient;
//use Wappr\Cloudflare\Resources\Account;
//use Wappr\Cloudflare\DataSets\HttpRequests\HttpRequests1dGroups;
//use Wappr\Cloudflare\SelectionSets\HttpRequests\HttpRequestsSum;
//use Spatie\Analytics\AnalyticsFacade as Analytics; //Change here

class HomeController extends Controller
{
    private $user;
    public $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function show(){
        $domain=$_SERVER['SERVER_NAME'];
        $site = SiteManage::where('web_site',$domain)->first();
        if($site){
            $images=FeatureImage::where('site_id',$site->id)->get();
            return view('content.index')->with(compact('images','site'));
        }
        else{
            return view('content.hp');
        }
    }
    public function policy(){
        $domain=$_SERVER['SERVER_NAME'];
        $site = SiteManage::where('web_site',$domain)->first();
        if($site){
            return view('content.policy')->with(compact('site'));
        }
        else{
            return view('content.hp');
        }
    }

    public function home()
    {
        return view('content.home');
    }

    public function facade()
    {
        return AnalyticsFacade::fetchMostVisitedPages(Period::days(7));
    }


    public function file()
    {
        return view('content.file.index');
    }

}
