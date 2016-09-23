<?php namespace App\Http\Controllers;

use App\Articles;
use DOMDocument;

class ArticlesController extends Controller {
  
  public function listAll($count=0){
    $articlesQuery = Articles::where('state','=','1')->orderBy('publish_up', 'DESC');
    if($count){
      $articlesQuery->take($count);
    }
    $articles= $articlesQuery->get(['id','title','images','introtext','publish_up','created','fulltext']);
    if($articles){
      return response()->json($this->formatArticle($articles), 200);
    }
    
    return response()->json(['data' => 'Articles not found'], 404);
  
  }
  
  public function getArticle($id){
    // $articles = Articles::find($id);
    $articles = Articles::where('id','=',$id)->get(['id','title','alias','images','introtext','publish_up','created','fulltext']);
    if($articles){
      // var_dump($articles);
      return response()->json($this->formatArticle($articles), 200);
    }
    
    return response()->json(['data' => 'Article can not be found'], 404);
  }
  
  public function getArticlesByCategory($id){
    $articles = Articles::where('catid','=', $id)->where('state','=','1')->orderBy('publish_up', 'DESC')->take(30)->get(['id','title','alias','images','introtext','publish_up','created','fulltext']);
    if($articles){
      // response()->header('Cache-Control','public, max-age=31536000');
      return response()->json($this->formatArticle($articles), 200)->header('Cache-Control','public, max-age=31536000');
    }
    
    return response()->json(['data' => 'Articles in this category not found'], 404);    
  }
  public function getfeaturedArticles($limit=0){
    $articlesQuery = Articles::where('featured','=', '1')->where('state','=','1')->orderBy('publish_up', 'DESC');
    if ($limit) {
     $articlesQuery->take($limit);
    }
    $articles=$articlesQuery->get(['id','title','alias','images','introtext','publish_up','created','fulltext']);
    if($articles){
        response();
      return response()->json($this->formatArticle($articles), 200)->header('Cache-Control','public, max-age=31536000');
    }
    
    return response()->json(['data' => 'Articles in this category not found'], 404);    
  }
  public function getLatestArticles($limit=10){
    $articles = Articles::where('state','=','1')->orderBy('publish_up', 'DESC')->take($limit)->get(['id','title','alias','images','introtext','publish_up','created','fulltext']);
    if($articles){
        response();
      return response()->json($this->formatArticle($articles), 200)->header('Cache-Control','public, max-age=3000');
    }
    
    return response()->json(['data' => 'Articles in this category not found'], 404);    
  }
  public function getArticlesByTag($tag,$limit=10){
    $articles = Articles::where('featured','=', '0')->where('state','=','1')->orderBy('publish_up', 'DESC')->take($limit)->get(['id','title','alias','images','introtext','publish_up','created','fulltext']);
    if($articles){
        response();
      return response()->json($this->formatArticle($articles), 200)->header('Cache-Control','public, max-age=31536000');
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
            if(!$article['introtext'] && !empty($article['fulltext']) ){
              $article['introtext']=$article['fulltext'];
            }elseif (!$article['fulltext'] && !empty($article['introtext'])) {
              $article['fulltext']=$article['introtext'];
            }
          
          } 
    }
    return $articles;
  }
  
}