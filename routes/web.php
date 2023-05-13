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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes([
    'confirm' => true,
    'register' => false,
    'reset' => true,
    'verify' => true,
]);

Route::redirect('/', 'dashboard', 301);
Route::get('dashboard', 'HomeController@index')->name('home');
Route::get('profile', 'ProfileController@show')->name('profile.show');
Route::get('profile/edit', 'ProfileController@edit')->name('profile.edit');
Route::post('profile', 'ProfileController@update')->name('profile.update');
Route::get('password/change', 'ChangePasswordController@edit')->name('password.change');
Route::post('password/change', 'ChangePasswordController@update');
Route::post('studentcheck/checkday', 'StudentCheckedController@checkday')->name('studentcheck.checkday');
Route::post('studentcheck/checked', 'StudentCheckedController@checked')->name('studentcheck.checked');
Route::get('checkday/{classId}', 'StudentCheckedController@checkedInfor')->name('checkday.checkedInfor');
Route::post('student/class', 'StudentController@student')->name('class.student');
Route::get('student/{classId}', 'StudentController@classStudent')->name('class.studentlist');
Route::post('classcourse/crclass', 'ClassCourseController@import')->name('classcourse.import');
Route::get('classcourse/crmany', 'ClassCourseController@crmany')->name('classcourse.crmany');

Route::resource('roles', 'RoleController');
Route::resource('users', 'UserController');
Route::resource('notifications', 'NotificationController')->only(['index', 'show', 'destroy']);
Route::resource('settings', 'SettingController');
Route::resource('students', 'StudentController');
Route::resource('studentcheck', 'StudentCheckedController');
Route::resource('studentcheckmanager', 'StudentCheckedManagerController');
Route::resource('classcourse', 'ClassCourseController');
Route::resource('teacher', 'TeacherController');
