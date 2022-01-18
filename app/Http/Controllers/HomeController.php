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

        $analytics = app(\Spatie\Analytics\Analytics::class);
        $total_visitors = $analytics->fetchVisitorsAndPageViews(Period::days(15));

//        $pages = Analytics::fetchMostVisitedPages(Period::days(1));
//        dd($pages);
//        $total_visitors = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        dd($total_visitors);


        $startDate = Carbon::now()->subYear();
        dd(Analytics::getAnalyticsService());
        $endDate = Carbon::now();
        $a = Period::create($startDate, $endDate);
        // $analytics = $analytics->fetchMostVisitedPages(Period::days(1));


        dd($a);


        $key     = new APIKey('ngocphandang@yahoo.com.vn', 'f4fb1dd91d4a7abce9460fe85f0cec82a6a69');
        $adapter = new Guzzle($key);
        $user    = new \Cloudflare\API\Endpoints\User($adapter);
//        dd($user->getUserID());
        $DNSAnalytics = new DNSAnalytics($adapter);
        $DNS = new DNS($adapter);
        $zoneID = '66ba85f3ec062939ed1098ffd82838e1';
        $dimensions = ["responseCode"]; //'queryName',
        $metrics = [ 'queryCount' ];
        $sort = [ ""];

//        adcc81574262d4b0cb57de58f6ed9967



//        $dataSet = new HttpRequestsSum();

//        $until = '2022-01-14T23:59:00Z';
        $until = Carbon::now()->toISOString(); //toISOString  ,toAtomString
//        dd($until);
        $since = Carbon::now()->subHour(6)->toISOString();  //subHour

//        dd($DNS->getRecordDetails($zoneID,'2960611a52aa4a9619c7452bef1f389d'));
        //dd($DNSAnalytics->getReportTable($zoneID,$dimensions,$metrics,$sort,'',$since,$until,100));
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
