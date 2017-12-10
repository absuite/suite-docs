<?php
$ns = 'Suite\Docs\Http\Controllers';
Route::prefix('api/docs')->middleware(['api', 'auth:api'])->namespace($ns)->group(function () {
	Route::resource('posts', 'PostController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	Route::resource('prices', 'PriceController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);
	Route::resource('tags', 'TagController', ['only' => ['index', 'show', 'store', 'update', 'destroy']]);

});