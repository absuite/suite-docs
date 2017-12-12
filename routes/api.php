<?php
$ns = 'Suite\Docs\Http\Controllers';
Route::prefix('api/docs')->middleware(['api', 'auth:api'])->namespace($ns)->group(function () {
	Route::resource('posts', 'PostController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	Route::resource('catalogs', 'CatalogController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	Route::resource('products', 'ProductController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

});