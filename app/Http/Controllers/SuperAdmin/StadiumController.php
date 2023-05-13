<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Admin\StoreAdmin;
use App\Models\Admin;
use App\Models\Stadium;
use App\Models\User;
use Illuminate\Http\Request;
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
        return view($this->view.'create',compact('users'));
    }

    public function edit($id)
    {
        return view($this->view.'edit');
    }
    public function show($id)
    {
        $data = Stadium::findOrFail($id);
        $users = Admin::all();
        return view($this->view.'show',compact('data','users'));
    }



    /**
    *   functions effect with db
    */
    public function store(Request $request)
    {
        $data = $request->all();
        if($request->file('image'))
        {
            $data['image'] = $this->uploadImage($request->file('image'),$this->stadiumPath);
        }
        
        if(Stadium::create($data))
        {
            return redirect()->back()->with('success','Success');
        }
        else{
            return redirect()->back()->with('error','Error Accure Try Again later');
        }
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
