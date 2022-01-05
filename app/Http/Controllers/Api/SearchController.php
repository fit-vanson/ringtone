<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\RingtoneResource;
use App\Models\Category;
use App\Models\Ringtone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function search(Request $request){
        $domain=$_SERVER['SERVER_NAME'];

        $query = $request->input('query');
        $ringtones=Ringtone::with('categories')->where('name', 'LIKE','%' . $query . '%')->take(20)->get();
        if($ringtones->isEmpty()){
            $ringtones=Ringtone::inRandomOrder()->take(20)->get();
        }
        $cate = Category::where('name', 'LIKE','%' . $query . '%')->take(20)->get();
        if($cate->isEmpty()){
            $cate = Category::inRandomOrder()->take(20)->get();
        }
        return [
            'cates_result' =>  CategoryResource::collection($cate),
            'ringtones_result' => RingtoneResource::collection($ringtones)
        ];

    }
}
