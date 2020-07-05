<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function image(Request $request, Filesystem $filesystem)
    {
        $this->validate($request , [
            'image' => 'required|mimes:jpeg,bmp,png|max:10240'
        ]);

        $file = $request->file('image');

        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $imagePath = "/upload/images/{$year}/{$month}/{$day}";
        $filename = $file->getClientOriginalName();

        if($filesystem->exists(public_path("{$imagePath}/{$filename}"))) {
            $filename = Carbon::now()->timestamp . "-{$filename}";
        }

        $file->move(public_path($imagePath) , $filename);

        return response([
            'data' => [
                'image-url' => url("{$imagePath}/{$filename}")
            ],
            'status' => 'success'
        ]);
    }
}
