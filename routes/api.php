<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Verb	      URI	                    Action	Route Name
// GET	      /articles	                index	articles.index
// GET	      /articles/{photo}	        show	articles.show 
// POST	      /articles	                store	articles.store
// PUT/PATCH  /articles/{photo}	        update	articles.update
// DELETE	  /articles/{photo}	        delete	articles.delete
Route::apiResource('articles', ArticleController::class);

