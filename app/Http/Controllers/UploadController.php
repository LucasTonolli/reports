<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function __invoke(Request $request)
    {
        $path = $request->file('file')->store('img');
        $url = Storage::url($path);
        logger($path);
        logger($url);
        return redirect()->back();
    }
}
