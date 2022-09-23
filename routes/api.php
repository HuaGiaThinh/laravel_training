<?php
use App\Http\Controllers\Api\EventController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Event api
Route::apiResource('events', EventController::class)->middleware('auth:api');

Route::get('events/{event}/editable', [EventController::class, 'editable'])->middleware('auth:api');
Route::get('events/{event}/editable/release', [EventController::class, 'release']);
Route::get('events/{event}/editable/maintain', [EventController::class, 'maintain']);


// Route::group(['prefix' => 'events', 'middleware' => ['auth:api']], function () {
//     Route::get('/{event}/editable', [EventController::class, 'editable'])->name('event.editable');
// });