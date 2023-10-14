<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;


class UploadFileService
{
    public function uploadFileStoreLogo($request)
    {
        if ($request->hasFile('logo')) {
            $destination_path = '/images/Store/Logo'; // ສ້າງ ຫຼື ອ້າງ folder path
            $imageFile = $request->file('logo'); 
            // Get just ext
            $extension = $imageFile->getClientOriginalExtension();
            // Filename to store
            $filename = 'store_logo' . '_' . time() . '.' . $extension;
            Storage::disk('public')->putFileAs($destination_path, $imageFile, $filename);

            return $filename;
        }
    }

    public function uploadFileUserProfile($request)
    {
        if ($request->hasFile('profile')) {
            $destination_path = '/images/Store/Profile';
            $imageFile = $request->file('profile'); 
            // Get just ext
            $extension = $imageFile->getClientOriginalExtension();
            // Filename to store
            $profilename = 'store_user_profile' . '_' . time() . '.' . $extension;
            Storage::disk('public')->putFileAs($destination_path, $imageFile, $profilename);

            return $profilename;
        }
    }

}