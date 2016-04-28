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

$app->get('/farmbiz_api/v', function () use ($app) {
    $farmbiz_api=  array(
    	'Name' => 'FarmBiz Africa',
    	'Version'=>'1.0.0',
    	'author'=>'Morris Mukiri',
    	'ok'=>TRUE
    	);
    return response()->json(['data' => $farmbiz_api], 200);
});
$app->get('/farmbiz_api/hello', function () use ($app) {
    return 'Nothing to see here';
});
$app->get('/farmbiz_api/categories','CategoriesController@listAll');

$app->get('/farmbiz_api/category/{id}', 'CategoriesController@getCategory');

$app->get('/farmbiz_api/articles', 'ArticlesController@listAll');
$app->get('/farmbiz_api/article/{id}', 'ArticlesController@getArticle');
$app->get('/farmbiz_api/category/{id}/articles', 'ArticlesController@getArticlesByCategory');