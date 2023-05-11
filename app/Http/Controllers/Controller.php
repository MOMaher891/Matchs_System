<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadImage($imageName,$request,$filePath)
    {
        if($request)
        {
       
            $file_path= $filePath;
            $image = $request->file($imageName);
            $filename = $image->hashName();
            $request->$imageName->move($file_path,$filename);
            return $filename;
        }else{
            return "Error";
        }
    }

    public function updateImage($oldImage,$newImage,$request,$filePath)
    {
        if($oldImage)
        {
            unlink($filePath.'/'.$oldImage);
        }

        if($newImage)
        {
        return $this->uploadImage($newImage,$request,$filePath);
        }else{
            return 'error';
        }

    }
}
