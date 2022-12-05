<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/addcategory",'App\Http\Controllers\QuestionController@addcategory'); 
Route::post("/addsubject",'App\Http\Controllers\QuestionController@addsubject'); 
Route::get("/getcategory",'App\Http\Controllers\QuestionController@getcategory'); 
Route::get("/getsubject",'App\Http\Controllers\QuestionController@getsubject'); 
Route::post("/addquestion",'App\Http\Controllers\QuestionController@addquestion'); 
Route::post("/addpackage",'App\Http\Controllers\QuestionController@addpackage'); 
Route::post("/addinpackage",'App\Http\Controllers\QuestionController@addinpackage'); 
Route::post("/starttest",'App\Http\Controllers\QuestionController@starttest'); 
Route::post("/addresponse",'App\Http\Controllers\QuestionController@addresponse'); 
Route::post("/customPackage",'App\Http\Controllers\QuestionController@customPackage'); 
Route::get("/getpackage",'App\Http\Controllers\QuestionController@getpackage'); 
Route::get("/questionbypackage",'App\Http\Controllers\QuestionController@questionbypackage'); 
Route::get("/gettest",'App\Http\Controllers\QuestionController@gettest'); 
Route::get("/testdetail",'App\Http\Controllers\QuestionController@testdetail'); 
Route::get("/getstats",'App\Http\Controllers\QuestionController@getstats'); 
Route::get("/getallquestion",'App\Http\Controllers\QuestionController@getallquestion'); 
Route::get("/getonlyquestion",'App\Http\Controllers\QuestionController@getonlyquestion'); 
Route::get("/getquestiondetail",'App\Http\Controllers\QuestionController@getquestiondetail');
Route::get("/getDayQuestion",'App\Http\Controllers\QuestionController@getDayQuestion');
Route::get("/addDay",'App\Http\Controllers\QuestionController@addDay');
Route::get("/getPreviousAnswer",'App\Http\Controllers\QuestionController@getPreviousAnswer');
Route::get("/getDayTip",'App\Http\Controllers\QuestionController@getDayTip');
Route::post("/login",'App\Http\Controllers\QuestionController@login');
Route::post("/register",'App\Http\Controllers\QuestionController@register');