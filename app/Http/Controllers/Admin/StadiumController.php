<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\City;
use App\Models\Region;
use App\Models\Stadium;
use App\Models\StadiumImage;
use App\Models\Time;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class StadiumController extends Controller
{
    //
    public function index()
    {
        $data = Stadium::owner()->with('region')->with('stadium_image')->latest();
        // return $data->get();
        return view('admin.stadium.index');
    }
    public function data()
    {
        $data = Stadium::owner()->with('region')->with('stadium_image')->latest();
        return DataTables::of($data)
        ->addColumn('actions',function($data){
            return view('admin.stadium.action',['type'=>'actions','data'=>$data]);
        })
        ->editColumn('region_id',function($data){
            return $data->region->name;
        })
        ->editColumn('description',function($d)
        {
            return view('admin.stadium.action',['type'=>'description','data'=>$d]);

        })
        ->editColumn('is_open',function($d)
        {
            return view('admin.stadium.action',['type'=>'is_open','data'=>$d]);

        })
        ->addColumn('image',function($data){
            return view('admin.stadium.action',['type'=>'image','data'=>$data]);

            // return $data->stadium_image[0]->image;
        })
        ->make(true);

    }


    public function create()
    {
        $cities = City::all();
        $times = Time::all();
        return view('admin.stadium.create',compact('cities','times'));
    }
    public function store(Request $request)
    {
        // Validation //
        $request->validate([
            'name'=>'required',
            "description"=>"required",
            'city'=>'required',
            'price'=>'required',
            'phone'=>'required',
            'num_of_player'=>'required',
            'period'=>'required',
            'lat'=>'required',
            'long'=>'required',
            'image'=>'required|array',
        ]);

    

        $request['clothes'] = $request->has('clothes') ? 1 : 0;
        $request['bathroom'] = $request->has('bathroom') ? 1 : 0;
        $request['s_bathroom'] = $request->has('s_bathroom') ? 1 : 0;
        $period = $this->implodeArr($request->period);

        $data = array(
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'admin_id'=>auth('admin')->user()->id,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'num_of_player'=>$request->num_of_player,
            'clothes'=>$request->clothes,
            'bathroom'=>$request->bathroom,
            's_bathroom'=>$request->s_bathroom,
            'period'=>$period,
            'region_id'=>$request->region_id,
            'weather'=>$request->weather
        );
        $stadium = Stadium::create($data)->id;

        if($request->hasFile('image')){
            foreach($request->image as $image){
                $image= $this->uploadImage($image,$this->stadiumPath);
                StadiumImage::create([
                    'image'=>$image,
                    'stadium_id'=>$stadium
                ]);
            }
        }
        return redirect()->back()->with('success','Success');
    }


    public function edit($id)
    {
        $cities = City::all();
        $times = Time::all();
        $data = Stadium::findOrFail($id);
        $openTime = $this->encodeTimes($data->period);
        $openTime = array_map('intval', $openTime);

        // return $openTime;

        return view('admin.stadium.edit',compact('data','cities','times','openTime'));
    }

    public function update(Request $request,$id)
    {
        $stadium = Stadium::findOrFail($id);
           // Validation //
        $request->validate([
            'name'=>'required',
            'city'=>'required',
            'phone'=>'required',
            'num_of_player'=>'required',
            'period'=>'array',
            'lat'=>'required',
            'long'=>'required'
        ]);

        // return $request->all();

        $request['clothes'] = $request->has('clothes') ? 1 : 0;
        $request['bathroom'] = $request->has('bathroom') ? 1 : 0;
        $request['s_bathroom'] = $request->has('s_bathroom') ? 1 : 0;
        $period = $this->implodeArr($request->period);

        $data = array(
            'name'=>$request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'phone'=>$request->phone,
            'admin_id'=>auth('admin')->user()->id,
            'lat'=>$request->lat,
            'long'=>$request->long,
            'num_of_player'=>$request->num_of_player,
            'clothes'=>$request->clothes,
            'bathroom'=>$request->bathroom,
            's_bathroom'=>$request->s_bathroom,
            'period'=>$period,
            'region_id'=>$request->region_id,
            'weather'=>$request->weather
        );

        $stadium->update($data);

        if($request->hasFile('image')){
            $dataImage =  StadiumImage::where('stadium_id',$stadium->id)->get();
            foreach($dataImage as $img)
            {
                $this->updateImage($img->image,null,$this->stadiumPath);
                $img->delete();
            }
            foreach($request->image as $image){
                $image= $this->uploadImage($image,$this->stadiumPath);
                StadiumImage::create([
                    'image'=>$image,
                    'stadium_id'=>$stadium->id
                ]);
            }
        }
        return redirect()->back()->with('success','Success');


    }
    public function toggleOpen(Request $request)
    {
        $data = Stadium::findOrFail($request->id);
        $data->is_open = $request->is_open;
        $data->save();
        return response()->json(['status'=>true]);
    }

    public function delete($id)
    {
        $data = Stadium::findOrFail($id);
        $stadImg =StadiumImage::where('stadium_id',$id)->get('image');
        foreach($stadImg as $img)
        {
            $this->updateImage($img->image,null,$this->stadiumPath);
        }
        $data->delete();
        return redirect()->back()->with('success','Deleted');
    }

    public function getRegions(Request $request){
        $regions = Region::where('city_id',$request->city_id)->get();
        $text = "";
        foreach ($regions as $region) {
            $text .= "<option value='$region->id'>$region->name</option>";
        }
        return $text;
    }

}
