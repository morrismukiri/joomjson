<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function version(){
        $App_Details=  array(
            'Name' => env('APP_NAME','JoomJSON'),
            'Version'=> env('APP_VERSION','1.0.0'),
            'author'=>env('APP_AUTHOR',''),
            'ok'=>TRUE
            );
        return response()->json($App_Details, 200);
    }
    public function index()
    {
        return $this->version();
    }
}
