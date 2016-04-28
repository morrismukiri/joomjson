<?php namespace App\Http\Controllers;

use App\Articles;

class ArticlesController extends Controller {
  
  public function listAll(){
    $articles = Articles::where('state','=','1')->get();
    
    if($articles){
       foreach ($articles as $article) {
        $article['intro_image']=json_decode($article['images'],true)['image_intro'];
      }
      return response()->json(['data' => $articles], 200);
    }
    
    return response()->json(['data' => 'Articles not found'], 404);
  
  }
  
  public function getArticle($id){
    $article = Articles::find($id);
    
    if($article){    
     foreach ($articles as $article) {
        $article['intro_image']=json_decode($article['images'],true)['image_intro'];
      }  
      return response()->json(['data' => $article], 200);
    } 
    
    return response()->json(['data' => 'Article can not be found'], 404);
  }
  
  public function getArticlesByCategory($id){
    $articles = Articles::where('catid','=', $id)->where('state','=','1')->orderBy('created', 'DESC')->get();
    
    if($articles){
      foreach ($articles as $article) {
        $article['intro_image']=json_decode($article['images'],true)['image_intro'];
      }

      return response()->json($articles, 200);
    }
    
    return response()->json(['data' => 'Articles in this category not found'], 404);    
  }
  
}