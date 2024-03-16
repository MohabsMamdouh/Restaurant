<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;


class BaseController extends Controller
{
    public function storeImage($image, $directory, $name)
    {
        $filename = $name . '.' . $image->getClientOriginalExtension();

        $imagePath = $image->storeAs($directory, $filename);

        return $imagePath;
    }
}
