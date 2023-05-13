<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $adminPath = 'uploads/superadmin/admin/';
    protected $userPath = 'uploads/admin/';
    protected $clientPath = 'uploads/client/';
    protected $stadiumPath = 'uploads/stadium/';

    public function uploadImage($image,$filePath)
    {
        $imageName =  $image->hashName();
        $path = $image->move(public_path($filePath), $imageName);
        return $imageName;
    }

    public function updateImage($oldImage, $newImage = null,$filePath)
    {
        if($oldImage)
        {
            unlink($filePath.'/'.$oldImage);
        }

        if($newImage != null)
        {
            return $this->uploadImage($newImage,$filePath);
        }
    }
}
