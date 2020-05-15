<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 29.08.16
 * Time: 11:37
 */

use RonasIT\Support\AutoDoc\Http\Controllers\AutoDocController;


Route::get('/auto-doc/{section}', ['uses' => AutoDocController::class . '@documentation']);
Route::get('/auto-doc/static/{file}', ['uses' => AutoDocController::class . '@getFile']);
Route::get(config('auto-doc.route'), ['uses' => AutoDocController::class . '@index']);
