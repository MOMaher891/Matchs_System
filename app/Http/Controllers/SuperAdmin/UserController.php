<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Admin\StoreAdmin;
use App\Http\Requests\SuperAdmin\Admin\UpdateAdmin;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    //
    protected $view = 'superadmin.users.';

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
        $user = Admin::find($id);
        return view($this->view.'edit',compact('user'));
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
            $data['image'] = $this->uploadImage($request->file('image'),$this->userPath);
        }
        $data['password'] = Hash::make($data['password']);
        if(Admin::create($data))
        {
            return redirect()->back()->with('success','Added Success');
        }
        else{
            return redirect()->back()->with('error','Error Accure Try Again later');
        }

    }

    public function delete($id)
    {
        $data = Admin::findOrFail($id);
        $this->updateImage($data->image,null,$this->userPath);
        $data->delete();
        return redirect()->back()->with('success','Deleted');
    }

    public function update(UpdateAdmin $request)
    {
        $data = $request->validated();
        $user  = Admin::findOrFail($request->id);
        if($request->file('image'))
        {
            $this->updateImage($user->image,$data['image'],$this->userPath);
        }
        $user->update($data);
        return redirect()->back()->with('success','Updated Success');

    }

    // datatables
    public function data()
    {
        $data = Admin::query();
        return DataTables::of($data)->addColumn('actions',function($data){
            return view($this->view.'actions',['type'=>'actions','data'=>$data]);
        })->editColumn('image',function($data){
            return view($this->view.'actions',['type'=>'image','data'=>$data]);
        })->make(true);
    }
}
