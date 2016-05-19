<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return 'Beautiful';
});

$app->get('v', function () use ($app) {
    $farmbiz_api=  array(
    	'Name' => 'FarmBiz Africa',
    	'Version'=>'1.0.0',
    	'author'=>'Morris Mukiri',
    	'ok'=>TRUE
    	);
    return response()->json(['data' => $farmbiz_api], 200);
});
$app->get('/hello', function () use ($app) {
    return 'Nothing to see here';
});
$app->get('categories','CategoriesController@listAll');

$app->get('category/{id}', 'CategoriesController@getCategory');

$app->get('articles', 'ArticlesController@listAll');
$app->get('article/{id}', 'ArticlesController@getArticle');
$app->get('category/{id}/articles', 'ArticlesController@getArticlesByCategory');
$app->get('articles/featured', 'ArticlesController@getfeaturedArticles');
$app->get('articles/latest[/{limit}]', 'ArticlesController@getLatestArticles');
$app->get('articles/latest/tag/{tag}[/{limit}]', 'ArticlesController@getArticlesByTag');
