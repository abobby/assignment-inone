<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');

/* Route for Members Module */
Route::group(['middleware' => 'web','prefix'=>'/member'], function(){
     Route::get('/add-member','MembersController@createMember');
     Route::post('/save-member','MembersController@saveMember');
     Route::get('/members-list','MembersController@listMembers');
     Route::get('/members-list-data','MembersController@listMembersData')
     ->name('members.data');;
     Route::get('/edit-member/{id}','MembersController@editMember');
     Route::post('/update-member','MembersController@updateMember');
});
