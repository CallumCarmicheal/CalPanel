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

// Return default homepage
Route::get('/', function () {
	return view('welcome');
});

// Setup the routes for auth
Auth::routes();

// Home
Route::get('/home', 'HomeController@index');

Route::get('/test', 'HomeController@test');

// User Messages
Route::get('/user/my/messages/{id}', 'UserController@getUserMessages');

// Administration pages
Route::group(['namespace'  =>  'Admin'], 
function() {
	// Home - Dashboard
	Route::get 		('/admin', 	  		   						'HomeController@index');
	Route::get 		('/admin/home', 		   					'HomeController@home');

	// User && Users 
	Route::get 		('/admin/users', 		   					'UsersController@index');  	// List users
	Route::get 		('/admin/users/{query}', 					'UsersController@query');  	// Lst'n'Qry
	Route::post 	('/admin/users/{query}', 					'UsersController@queryp');  // Lst'n'Qry
	Route::get 		('/admin/user/{id}', 	   					'UsersController@view');    // View user
	Route::patch 	('/admin/user/{id}',   						'UsersController@update'); 	// Upd User
	Route::delete 	('/admin/user/{id}',  						'UsersController@delete'); 	// Del User
	
	// Role && Roles
	Route::get 		('/admin/roles', 		   					'RolesController@index');  	// List roles
	Route::get 		('/admin/roles/{query}', 					'RolesController@query');  	// Lst'n'Qry
	Route::post 	('/admin/roles/{query}', 					'RolesController@queryp');  // Lst'n'Qry
	Route::get 		('/admin/role/{slug}', 	   					'RolesController@view');    // View user
	Route::patch 	('/admin/role/{slug}',   					'RolesController@update'); 	// Upd role
	Route::delete 	('/admin/role/{slug}',  					'RolesController@delete'); 	// Del role
	Route::patch	('/admin/role/{slug}/u/{id}',				'RolesController@AddUser'); // Add User
	Route::delete	('/admin/role/{slug}/u/{id}', 				'RolesController@RemUser'); // Delete User
	Route::patch	('/admin/roles/c/{slug}/{name}/{desc}',		'RolesController@MakeRole');
	
	// Misc Ajax Requests
	Route::post		('/admin/ajax/user/exists/id/{id}', 		'AjaxController@__todo');
	Route::post		('/admin/ajax/user/exists/em/{em}', 		'AjaxController@__todo');
	Route::post		('/admin/ajax/user/list/ac/{slug}/{query}',	'AjaxController@QueryUserList');
});