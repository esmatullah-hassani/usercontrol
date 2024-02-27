<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\Http\Controllers\Students\CompetencyExamController;

Auth::routes();
Route::get('language/{lang}', [
    'uses' => 'Localize\LocalizeController@index',
    'as' => 'lang.set'
]);
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'locale'], function () {

        Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
        
       
        Route::resource('roles', 'Roles\RolesController', ['except' => ['show']]);
        Route::resource('rolePermissions', 'Roles\RolePermissionsController', [
            'only' => ['edit', 'update'],
            'parameters' => ['rolePermissions' => 'role']
        ]);
        //Users Routes
        Route::resource('users', 'Users\UsersController');
        Route::post('{user}/idCard', 'Users\UsersController@idCard')->name('users.cards.id');
        Route::get('onlineUsers', 'Users\UsersController@onlineUsers')->name('users.onlines');
        Route::get('users/{user}/photo', 'Users\PhotoController@index')->name('users.photo');
        Route::get('users/{user}/roles', 'Users\UserRolesController@edit')->name('users.roles.edit');
        Route::put('users/{user}/roles', 'Users\UserRolesController@update')->name('users.roles.update');
        
        //Impersonation...
        Route::get('impersonate/{user}', 'ImpersonationController@impersonate')->name('impersonate');
        Route::get('stopImpersonating', 'ImpersonationController@stopImpersonating')->name('impersonate.stop');
        
    });
});
Route::get('/users/idCard/{id_card}','Users\UsersVerifywithBarcodController@index');
//end locale setter
