<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Admin\StoreAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    //
    protected $view = 'superadmin.admins.';

    /**
    * view functions
    */
    public function index()
    {
        return view($this->view.'index');

    }

    public function create()
    {
        return view($this->view.'create');
    }

    public function edit($id)
    {
        return view($this->view.'edit');
    }

    /**
    *   functions effect with db
    */
    public function store(StoreAdmin $request)
    {
        $data = $request->validated();
        // return $data;
        if($request->file('image'))
        {
            $data['image'] = $this->uploadImage($request->file('image'),$this->adminPath);
        }
        $data['password'] = Hash::make($data['password']);
        if(User::create($data))
        {
            return redirect()->back()->with('success','Success');
        }
        else{
            return redirect()->back()->with('error','Error Accure Try Again later');
        }
    }
    public function delete($id)
    {
        $data = User::findOrFail($id);
        $this->updateImage($data->image,null,$this->adminPath);
        $data->delete();
        return redirect()->back()->with('success','Deleted');
    }
    public function update(StoreAdmin $request,$id)
    {
        $data = $request->validated();
        $user  = User::findOrFail($id);
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
        $data = User::query();
        return DataTables::of($data)->addColumn('actions',function($data){
            return view($this->view.'actions',['type'=>'actions','data'=>$data]);
        })->editColumn('image',function($data){
            return view($this->view.'actions',['type'=>'image','data'=>$data]);
        })->make(true);
    }
}
