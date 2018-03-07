<?php

use Illuminate\Http\Request;

Route::post('forgot-password', 'UserController@forgotPassword');
Route::post('reset-password', 'UserController@resetPassword');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::get('/login', function (Request $request) {
    echo '<pre>';print_r($request);
})->middleware('auth:api');


Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {
    Route::get('user-list', 'UserController@getUserList');

    /*Chat urls*/
    Route::post('get-user-conversation', 'ChatController@getUserConversationById');
    Route::post('save-chat', 'ChatController@saveUserChat');

    /*Private Message urls*/
    Route::post('get-private-message-notifications', 'PrivateMessageController@getUserNotifications');
    Route::post('get-private-messages', 'PrivateMessageController@getPrimateMessages');
    Route::post('get-private-message', 'PrivateMessageController@getPrivateMessageById');
    Route::post('get-private-messages-sent', 'PrivateMessageController@getPrivateMessageSent');
    Route::post('send-private-message', 'PrivateMessageController@sendPrivateMessage');
    Route::post('file-upload', 'FileUploadController@index')->name('file.upload');
    Route::post('file-destory', 'FileUploadController@destory')->name('file.destory');
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api', 'namespace' => 'frontEnd'], function () {
    Route::get('categories', 'CategoriesController@index')->name('front.categories.list');

    Route::group(['prefix' => 'bids'], function () {
        Route::get('list', 'BidsController@index')->name('front.bids.list');
        Route::get('show/{id}', 'BidsController@show')->name('front.bids.show');
        Route::post('store', 'BidsController@store')->name('front.bids.store');
        Route::post('update/{id}', 'BidsController@update')->name('front.bids.update');
        Route::post('delete/{id}', 'BidsController@destroy')->name('front.bids.delete');
    });

});
