<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FotoTempatController extends Controller
{
    public function show($filename)
    {
        $path = 'public/foto_tempats/' . $filename;
        return response()->file(Storage::path($path));
    }
}
