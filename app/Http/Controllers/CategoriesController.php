<?php namespace App\Http\Controllers;

use App\Categories;

class CategoriesController extends Controller {
  
  public function listAll(){
    $categories = Categories::where('extension','=','com_content')->where('published','=','1')->orderBy('lft', 'ASC')->get();
    
    if(!$categories->isEmpty()){
      return response()->json($categories, 200);
    }
    
    return response()->json(['error' => 'Categories not found'], 404);
  }
  
  public function getCategory($id){
    $category = Categories::find($id);
    
    if(!is_null($category)){
      return response()->json($category, 200);
    }
    
    return response()->json(['error' => 'Category not found'], 404);
    
  }
  
}