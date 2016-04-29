<?php namespace App\Http\Controllers;

use App\Articles;
use DOMDocument;

class ArticlesController extends Controller {
  
  public function listAll(){
    $articles = Articles::where('state','=','1')->orderBy('publish_up', 'DESC')->get(['id','title','images','introtext','publish_up','created']);
    if($articles){
      return response()->json($this->formatArticle($articles), 200);
    }
    
    return response()->json(['data' => 'Articles not found'], 404);
  
  }
  
  public function getArticle($id){
    // $articles = Articles::find($id);
    $articles = Articles::where('id','=',$id)->get(['id','title','images','introtext','publish_up','created']);
    if($articles){
      // var_dump($articles);
      return response()->json($this->formatArticle($articles), 200);
    }
    
    return response()->json(['data' => 'Article can not be found'], 404);
  }
  
  public function getArticlesByCategory($id){
    $articles = Articles::where('catid','=', $id)->where('state','=','1')->orderBy('publish_up', 'DESC')->get(['id','title','images','introtext','publish_up','created']);
    if($articles){
      return response()->json($this->formatArticle($articles), 200);
    }
    
    return response()->json(['data' => 'Articles in this category not found'], 404);    
  }
  public function getfeaturedArticles(){
    $articles = Articles::where('featured','=', '1')->where('state','=','1')->orderBy('publish_up', 'DESC')->get(['id','title','images','introtext','publish_up','created']);
    if($articles){
      return response()->json($this->formatArticle($articles), 200);
    }
    
    return response()->json(['data' => 'Articles in this category not found'], 404);    
  }
  function formatArticle($articles){
    if($articles){
         foreach ($articles as $article) {
            $article['intro_image']=json_decode($article['images'],true)['image_intro'];
            if(!$article['intro_image']){
              $newDom = new DOMDocument();
              @$newDom->loadHTML($article['introtext']);

              $tags = $newDom->getElementsByTagName('img');
              $firstURL="";
              foreach ($tags as $tag) {
                $tagURL=$tag->getAttribute('src');
                if($tagURL){
                  $article['intro_image']=$tagURL;
                  break;
                }
              }
              
            }
          
          } 
    }
    return $articles;
  }
  
}