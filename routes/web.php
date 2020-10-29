<?php

Route::get('/', function () {
    if (Auth::guest()) {
        return view('auth/login');
    }
    return redirect()->route('home');
});

Auth::routes();
Route::get('/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('reset');
Route::group(['middleware' => ['auth']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'ProfilesController@index')->name('profile');
    Route::post('/profile/edit', 'ProfilesController@edit')->name('edit-profile');
    Route::get('/markNotifications', 'NotificationController@markAsRead')->name('markRead');
    
    Route::group(['middleware' => ['not_unsuscribed']], function() {

        Route::get('/incidence', 'IncidenceController@index')->name('incidence');
        Route::get('/my-incidences', 'IncidenceController@showMyIncidences')->name('my-incidences');
        Route::get('/show-incidences', 'IncidenceController@show')->name('show-incidences');
        Route::get('/edit-incidence/{id}', 'IncidenceController@editview')->name('edit-incidence');
        Route::get('/incidence/{id}', 'IncidenceController@showIncidenceById')->name('showinc');
        
        Route::get('/status/{id}/{status}', 'IncidenceController@changeStatus');
        
        Route::post('/createrol/{id}', 'RolController@insert');
        Route::post('/deleterol', 'RolController@delete');

        Route::group(['middleware' => ['is_admin']], function() {

            // users 

            Route::get('/modifyuser', 'UserController@modifyUsersIndex')->name('modifyuser');
            Route::get('/createuser', 'UserController@createIndex')->name('createuser');
            Route::post('/insertmanual', 'UserController@insertManual');
            Route::post('/uploadFile', 'UserController@importFile');
            Route::post('/edit-user', 'UserController@modifyUser');
            Route::post('/delete-user', 'UserController@deleteUser');
            Route::post('/suscribe-user', 'UserController@suscribeUser');
            Route::post('/checkAdmin', 'UserController@checkAdmin');
            
            // rols 
            
            Route::get('/rol/{id}','RolController@index');

            // category

            Route::get('/category', 'CategoryController@index')->name('category');
            Route::get('/fetch-last-category', 'CategoryController@getLastCategory');
            Route::post('/create-category', 'CategoryController@insertCategory');
            Route::post('/update-category', 'CategoryController@updateCategory');
            Route::post('/delete-category', 'CategoryController@deleteCategory');
            
            // incidences
            
            Route::get('/searchIncidences', 'IncidenceController@searchIncidences')->name('search');
            Route::get('/fetchall', 'IncidenceController@fetchAll');
            Route::get('/fetchpendent', 'IncidenceController@fetchPendent');
            Route::get('/fetchproces', 'IncidenceController@fetchProces');
            Route::get('/fetchresolta', 'IncidenceController@fetchResolta');
        });


        // Incidences

        
        Route::post('/create', 'IncidenceController@insert');
        Route::post('/edit/{id}', 'IncidenceController@edit');
        Route::post('/addComment/{id}', 'CommentsController@insert');
    });
});

// Route created for translations

Route::get('locale/{locale}', function($locale) {

    Session::put('locale', $locale);

    return redirect()->back();
});
