<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    //
     public function successResponse($data, $code){
    return response()->json(['data' => $data], $code);
  }
  
  public function failureResponse($data, $code){
    return response()->json(['data' => $data], $code);
  }
}
