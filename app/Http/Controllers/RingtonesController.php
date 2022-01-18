<?php

namespace App\Http\Controllers;

use App\Models\CategoryManage;
use App\Models\Ringtone;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use mysql_xdevapi\Exception;
use Spatie\Permission\Models\Role;

class RingtonesController extends Controller
{
    private $user;
    public $role;
    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }
    public function index(Request $request)
    {
        $pageConfigs = ['pageHeader' => false];
        $categories = CategoryManage::where('id', '<>', 1)->get();
        return view('content.ringtone.index', [
            'pageConfigs' => $pageConfigs,

            'categories' => $categories
        ]);
    }
    public function getIndex(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // total number of rows per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');



        $columnIndex = $columnIndex_arr ?  $columnIndex_arr[0]['column'] : '2'; // Column index
        $columnName = $columnName_arr ?  $columnName_arr[$columnIndex]['data'] : 'name'; // Column name
        $columnSortOrder = $order_arr?  $order_arr[0]['dir'] :'asc'; // asc or desc
        $searchValue = $search_arr ? $search_arr['value'] :''; // Search value


        if(isset($request->category)){
            $searchValue = $request->category;
        }

        $totalRecords = Ringtone::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Ringtone::with('categories')->select('count(*) as allcount')
            ->leftJoin('category_has_ringtones', 'category_has_ringtones.ringtone_id', '=', 'ringtones.id')
            ->leftJoin('categories', 'categories.id', '=', 'category_has_ringtones.category_id')
            ->where('ringtones.name', 'like', '%' . $searchValue . '%')
            ->orWhere('categories.name', 'like', '%' . $searchValue . '%')
            ->count();
        $records = Ringtone::with('categories')->orderBy($columnName, $columnSortOrder)
            ->leftJoin('category_has_ringtones', 'category_has_ringtones.ringtone_id', '=', 'ringtones.id')
            ->leftJoin('categories', 'categories.id', '=', 'category_has_ringtones.category_id')
            ->where('ringtones.name', 'like', '%' . $searchValue . '%')
            ->orWhere('categories.name', 'like', '%' . $searchValue . '%')
            ->select('ringtones.*','categories.name as name_cate')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();
        foreach ($records as $key => $record) {
            $cate_name = [];
            foreach ($record->categories as $category){
                $cate_name[] =$category->name;
            }
            $data_arr[] = array(
                "id" => $record->id,
                "name" => $record->name,
                "feature" => $record->feature,
                "set_as_premium" => $record->set_as_premium,
                "ringtone_file" => $record->ringtone_file,
                "thumbnail_image" => $record->thumbnail_image,
                "view_count" => $record->view_count,
                "like_count" => $record->like_count,
                "downloads" => $record->downloads,
                "categories.name" => $cate_name[0],
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        );

        echo json_encode($response);
    }
    public function create(Request $request)
    {
        Log::error($request->all());
        if($request->file){
            $rules = [
                'file' => 'max:20000|mimes:mp3'
            ];
            $message = [
                'file.mimes'=>'Định dạng File',
                'file.max'=>'Dung lượng File',
            ];

            $error = Validator::make($request->all(),$rules, $message );
            if($error->fails()){
                return response()->json(['errors'=> $error->errors()->all()]);
            }

            $file = $request->file;

            $ringtone= new Ringtone();
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $nameImage =  preg_replace('/[^A-Za-z0-9\-\']/', '_', $filename);
            $extension = $file->getClientOriginalExtension();
            $fileNameToStore = $nameImage.'_'.time().'.'.$extension;

            $now = new \DateTime('now'); //Datetime
            $monthNum = $now->format('m');
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F'); // Month
            $year = $now->format('Y'); // Year
            $monthYear = $monthName.$year;
            $path=Storage::disk('record_file')->putFileAs($monthYear,$file, $fileNameToStore);
            $ringtone->name = $filename;
            $ringtone->ringtone_file=$path;
            $ringtone->view_count = rand(500,1000);
            $ringtone->like_count = rand(500,1000);
            $ringtone->save();
            $ringtone->categories()->attach($request->select_category);
            return response()->json(['success'=>'Thành công']);
        }
    }
    public function update(Request $request){
        $id = $request->id;
        $rules = [
            'file' => 'max:20000|mimes:mp3'
        ];
        $message = [
            'file.mimes'=>'Định dạng File',
            'file.max'=>'Dung lượng File',
        ];

        $error = Validator::make($request->all(),$rules, $message );
        if($error->fails()){
            return response()->json(['errors'=> $error->errors()->all()]);
        }
        $data = Ringtone::find($id);
        $data->name = $request->ringtone_name;
        $data->view_count = $request->ringtone_viewCount;
        $data->like_count = $request->ringtone_likeCount;
        if($request->feature){
            $data->feature  = 1;
        }else{
            $data->feature  = 0;
        }
        if($request->set_as_premium){
            $data->set_as_premium  = 1;
        }else{
            $data->set_as_premium  = 0;
        }
        $data->categories()->sync($request->select_category);
        $data->save();
        return response()->json(['success'=>'Cập nhật thành công']);
    }
    public function edit($id)
    {
        $data = Ringtone::with('categories')->where('id',$id)->first();
        return response()->json($data);
    }
    public function delete($id)
    {
        $ringtone = Ringtone::find($id);
        $pathRemove    =   storage_path('app/public/ringtones/').$ringtone->ringtone_file;
        try {
            if(file_exists($pathRemove)){
                unlink($pathRemove);
            }
        }catch (Exception $ex) {
            Log::error($ex->getMessage());
        }
        $ringtone->categories()->detach();
        $ringtone->delete();

        return response()->json(['success'=>'Xóa thành công.']);
    }
    public function deleteSelect(Request $request)
    {
        $id = $request->id;
        $ringtones = Ringtone::whereIn('id',$id)->get();
        foreach ( $ringtones as $ringtone){
            $path_Remove =   storage_path('app/public/ringtones/').$ringtone->ringtone_file;
//            dd($path_thumbnail);
            try {
                if(file_exists($path_Remove)){
                    unlink($path_Remove);
                }
            }catch (Exception $ex) {
                Log::error($ex->getMessage());
            }
            $ringtone->categories()->detach();
            $ringtone->delete();
        }
        return response()->json(['success'=>'Xóa thành công.']);
    }

}
