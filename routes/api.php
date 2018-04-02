<?php

use Illuminate\Http\Request;

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

Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('employee-client', 'EmployeeController@index');

    Route::get('exportCsv/employee/{employee_id}/{client_id}', 'EmployeeController@exportCsv')
        ->where(['employee_id' => '[0-9]+', 'client_id' => '[0-9]+']);

    Route::get('current-employee/{project_id}', 'EmployeeController@currentlyAssignedEmployee');

    Route::get('spent-time/project/{id}', 'ProjectController@spentTime');

    Route::get('peak-time/{day}/{project_id}', 'ProjectController@peakTime')
        ->where(['day' => '[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])',
            'project_id' => '[0-9]+']);
});

