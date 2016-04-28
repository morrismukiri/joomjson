<?php namespace App\Http\Controllers;

use App\Categories;

class CategoriesController extends Controller {
  
  public function listAll(){
    $categories = Categories::where('extension','=','com_content')->where('published','=','1')->orderBy('lft', 'ASC')->get();
    
    if($categories){
      return response()->json(['data' => $categories], 200);
    }
    
    return response()->json(['data' => 'Categories not found'], 404);
  }
  
  public function getCategory($id){
    $category = Categories::find($id);
    
    if($category){
      return response()->json(['data' => $category], 200);
    }
    
    return response()->json(['data' => 'Category not found'], 404);
    
  }
  
}