<?php

/**
 * Routes needed for authorization.
 *
 */

Route::group(['
    middleware' => ['web', 'auth']
], function ($router) {
    Route::get('/oauth/authorize', [
        'uses' => 'AuthorizationController@authorize',
    ]);

    Route::post('/oauth/authorize', [
        'uses' => 'ApproveAuthorizationController@approve',
    ]);

    Route::delete('/oauth/authorize', [
        'uses' => 'DenyAuthorizationController@deny',
    ]);
});


/**
* Routes for retrieving and issuing access tokens.
*/
Route::post('/oauth/token', [
    'uses' => 'AccessTokenController@issueToken',
    'middleware' => 'throttle'
]);

Route::group(
    ['middleware' => ['web', 'auth']
], function ($router) {
    Route::get('/oauth/tokens', [
        'uses' => 'AuthorizedAccessTokenController@forUser',
    ]);

    Route::delete('/oauth/tokens/{token_id}', [
        'uses' => 'AuthorizedAccessTokenController@destroy',
    ]);
});


/**
* Routes needed for refreshing transient tokens.
*/
Route::post('/oauth/token/refresh', [
    'middleware' => ['web', 'auth'],
    'uses' => 'TransientTokenController@refresh',
]);

/**
* Routes needed for managing clients.
*/
Route::group(
    ['middleware' => ['web', 'auth']
], function ($router) {
    Route::get('/oauth/clients', [
        'uses' => 'ClientController@forUser',
    ]);

    Route::post('/oauth/clients', [
        'uses' => 'ClientController@store',
    ]);

    Route::put('/oauth/clients/{client_id}', [
        'uses' => 'ClientController@update',
    ]);

    Route::delete('/oauth/clients/{client_id}', [
        'uses' => 'ClientController@destroy',
    ]);
});
/**
* Routes needed for managing personal access tokens.
*/
Route::group(
    ['middleware' => ['web', 'auth']
], function ($router) {
    Route::get('/oauth/scopes', [
        'uses' => 'ScopeController@all',
    ]);

    Route::get('/oauth/personal-access-tokens', [
        'uses' => 'PersonalAccessTokenController@forUser',
    ]);

    Route::post('/oauth/personal-access-tokens', [
        'uses' => 'PersonalAccessTokenController@store',
    ]);

    Route::delete('/oauth/personal-access-tokens/{token_id}', [
        'uses' => 'PersonalAccessTokenController@destroy',
    ]);
});
?>