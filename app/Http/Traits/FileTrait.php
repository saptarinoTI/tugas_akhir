<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;

trait FileTrait
{
    public function upload($request, $name, $file_dir, $file_name)
    {
        $file_req = $request->file($name);
        $ext = $file_req->extension();
        $save_file = $file_req->storeAs($file_dir, $file_name . '.' . $ext, 'public');
        return $save_file;
    }

    public function updateFile($request, $name, $file_dir, $file_name)
    {
        $file_req = $request->file($name);
        $ext = $file_req->extension();
        $save_file = $file_req->storeAs($file_dir, $file_name . '.' . $ext, 'public');
        return $save_file;
    }

    public function deleteFile($file_name)
    {
        $file = File::delete('storage/' . $file_name);
        return $file;
    }
}
