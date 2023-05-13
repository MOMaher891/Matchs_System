<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SuperAdmin\Admin\StoreAdmin;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class ClientController extends Controller
{
    //
    protected $view = 'superadmin.clients.';

    /**
    * view functions
    */
    public function index()
    {
        return view($this->view.'index');
    }
    public function edit($id)
    {
        return view($this->view.'edit');
    }

    /**
    *   functions effect with db
    */

    public function delete($id)
    {
        $data = Client::findOrFail($id);
        $this->updateImage($data->image,null,$this->adminPath);
        $data->delete();
        return redirect()->back()->with('success','Deleted');
    }
    public function update(Request $request,$id)
    {
        // $data = $request->validated();
        // $user  = Client::findOrFail($id);
        // if($request->file('image'))
        // {
        //     $this->updateImage($user->image,$request['image'],$this->clientPath);
        // }
        // $user->update($request);
        // return redirect()->back()->with('success','Success');

        return $request;

    }

    // datatables
    public function data()
    {
        $data = Client::query();
        return DataTables::of($data)->addColumn('actions',function($data){
            return view($this->view.'actions',['type'=>'actions','data'=>$data]);
        })->editColumn('image',function($data){
            return view($this->view.'actions',['type'=>'image','data'=>$data]);
        })->editColumn('is_blocked',function($data){
            return view($this->view.'actions',['type'=>'is_blocked','data'=>$data]);
        })->make(true);
    }

    public function toggle(Request $request){
        $client = Client::findOrFail( $request->clientID);

        if($client->is_blocked ==0){
            $client->is_blocked = 1;
            $client->save();
        }else{
            $client->is_blocked = 0;
            $client->save();
        }
    }
}
