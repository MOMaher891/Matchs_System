<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Admin\StoreAdmin;
use App\Models\Admin;
use App\Models\City;
use App\Models\Country;
use App\Models\Region;
use App\Models\Stadium;
use App\Models\StadiumImage;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class StadiumController extends Controller
{
    //
    protected $view = 'superadmin.stadiums.';

    /**
    * view functions
    */
    public function index()
    {
        return view($this->view.'index');
    }

    public function create()
    {
        $users = Admin::all();
        $cities = City::all();
        $times = Time::all();
        return view($this->view.'create',compact('users','cities','times'));
    }

    public function getRegions($city_id){
        $regions = Region::where('city_id',$city_id)->get();
        $text = "";
        foreach ($regions as $region) {
            $text .= "<option value='$region->id'>$region->name</option>";
        }
        return $text;
    }

    public function edit($id)
    {
        return view($this->view.'edit');
    }
    public function show($id)
    {
        $data = Stadium::with(['admin','region'=>function($q){
            $q->with('city')->get();
        }])->findOrFail($id);
        $period = explode(',', $data);
        $times = Time::whereIn('id',$period)->get();
        $images = StadiumImage::where('stadium_id',$id)->get('image');
        // return $data;
        return view($this->view.'show',compact('data','images','times'));
    }



    /**
    *   functions effect with db
    */
    public function store(Request $request)
    {
        $request['clothes'] = $request->has('clothes') ? 1 : 0;
        $request['bathroom'] = $request->has('bathroom') ? 1 : 0;
        $request['s_bathroom'] = $request->has('s_bathroom') ? 1 : 0;
        $period = implode(',', $request->period);
        // return $request->all();
        /**
         * Get Country & City & Region from lat and long numbers
         */
        // $apiKey = 'UZ9U7TZG0ADA9VGZTJMSZIYPBWZNVQ4Y';
        // $params['format']   = 'json';
        // $params['lat']      = $request->lat;
        // $params['lng']      = $request->long;
        // $query = '';
        // foreach($params as $key=>$value){
        //     $query .= '&' . $key . '=' . rawurlencode($value);
        // }
        // $result = file_get_contents('https://api.geodatasource.com/city?key=' . $apiKey . $query);
        // $location = json_decode($result);

        // $country =array(
        //     'name'=>$location->country
        // );
        // $country_id = DB::table('countries')->insertGetId($country);
        // // $city = DB::table('cities')->insertGetId()
        // City::create([
        //     'country_id'=>$country_id,
        //     'name'=>$location->city
        // ]);

        $data = array(
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'admin_id'=>$request->admin_id,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'num_of_player'=>$request->num_of_player,
            'clothes'=>$request->clothes,
            'bathroom'=>$request->bathroom,
            's_bathroom'=>$request->s_bathroom,
            'period'=>$period,
            'region_id'=>$request->region_id,
        );

        $stadium = DB::table('stadiums')->insertGetId($data);

        // $images =[];
        if($request->hasFile('image')){
            foreach($request->image as $image){
                $image=$this->uploadImage($image,$this->stadiumPath);
                StadiumImage::create([
                    'image'=>$image,
                    'stadium_id'=>$stadium
                ]);
            }
        }

        return redirect()->back()->with('success','Success');

    }
    public function delete($id)
    {
        $data = Stadium::findOrFail($id);
        $this->updateImage($data->image,null,$this->adminPath);
        $data->delete();
        return redirect()->back()->with('success','Deleted');
    }
    public function update(StoreAdmin $request,$id)
    {
        $data = $request->validated();
        $user  = Stadium::findOrFail($id);
        if($request->file('image'))
        {
            $this->updateImage($user->image,$data['image'],$this->adminPath);
        }
        $user->update($data);
        return redirect()->back()->with('success','Success');

    }

    // datatables
    public function data()
    {
        $data = Stadium::query();
        return DataTables::of($data)->addColumn('actions',function($data){
            return view($this->view.'actions',['type'=>'actions','data'=>$data]);
        })->editColumn('image',function($data){
            return view($this->view.'actions',['type'=>'image','data'=>$data]);
        })->editColumn('description',function($data){
            return view($this->view.'actions',['type'=>'desc','data'=>$data->description]);
        })->make(true);
    }
}
