<?php

namespace App\Http\Controllers\Api;


use App\Http\Resources\RingtoneResource;
use App\Models\Ringtone;
use App\Models\Visitor;
use App\Models\VisitorFavorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class FavoriteController extends Controller
{
    public function likeRingtone(Request $request)
    {
        $visitor = Visitor::where('device_id', $request->device_id)->first();
        if (!$visitor) {
            Visitor::create([
                'device_id' => $request->device_id
            ]);
        }
        $visitorFavorite = VisitorFavorite::where([
            'ringtone_id' => $request->ringtone_id,
            'visitor_id' => Visitor::where('device_id', $request->device_id)->value('id')])->first();
        $response = array();
        if ($visitorFavorite) {
            return response()->json(['warning' => ['This Wallpaper has already in your List']], 200);
        } else {
            $response['save_wallpaper'] = ['success' => 'Save Wallpaper Successfully'];
            VisitorFavorite::create([
                'ringtone_id' => $request->ringtone_id,
                'visitor_id' => Visitor::where('device_id', $request->device_id)->value('id')
            ])->first();
            $ringtone = Ringtone::where('id', $request->ringtone_id)->first();
            $ringtone->increment('like_count');
        }
        return response()->json($response, ResponseAlias::HTTP_OK);
    }

    public function disLikeRingtone(Request $request)
    {
        if (!checkBlockIp()) {
            $visitorFavorite = VisitorFavorite::where([
                'ringtone_id' => $request->ringtone_id,
                'visitor_id' => Visitor::where('device_id', $request->device_id)->value('id')])->first();
            $response = array();
            if ($visitorFavorite) {
                VisitorFavorite::where([
                    'ringtone_id' => $request->ringtone_id,
                    'visitor_id' => Visitor::where('device_id', $request->device_id)->value('id')
                ])->delete();
                $ringtone = Ringtone::where('id', $request->ringtone_id)->first();
                $ringtone->decrement('like_count');
                return response()->json(['success' => ['Completely Delete this Wallpaper out of your List']], 200);
            } else {
                $response['warning'] = ['success' => 'This ringtone is not in your list'];
            }
            return response()->json($response, Response::HTTP_OK);
        }else{
            return response()->json([
                'message'=>'You are not allow to do this action'
            ]);
        }
    }

    public function getSaved($device_id)
    {
        if (!checkBlockIp()) {
            $visitor = Visitor::where('device_id', $device_id)->first();
            try {
                $data = Visitor::findOrFail($visitor->id)
                    ->ringtones()
                    ->paginate(7);
                $getResource = RingtoneResource::collection($data);
                if ($data->isEmpty()) {
                    return response()->json([], 200);
                }
                return $getResource;
            } catch (\Exception $e) {
                return response()->json([], 200);
            }
        } else {
            return response()->json([
                'message' => 'You are not allow to do this action'
            ]);
        }
    }

}
