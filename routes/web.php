<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->group(function(){
	//Specialty (rutas manuales)
	Route::get('/specialties', 'SpecialtyController@index')->name('specialties.index');
	Route::get('/specialties/create', 'SpecialtyController@create')->name('specialties.create');
	Route::get('/specialties/{specialty}/edit', 'SpecialtyController@edit')->name('specialties.edit');
	Route::post('/specialties', 'SpecialtyController@store')->name('specialties.store');
	Route::put('/specialties/{specialty}', 'SpecialtyController@update')->name('specialties.update');
	Route::delete('/specialties/{specialty}', 'SpecialtyController@destroy')->name('specialties.destroy');

	//Doctors (rutas con resource)
	Route::resource('doctors', 'DoctorController');

	//Patients (rutas con resource)
	Route::resource('patients', 'PatientController');
});

Route::middleware(['auth', 'doctor'])->namespace('Doctor')->group(function(){
	//Horario (rutas manuales)
	Route::get('/schedule', 'ScheduleController@edit')->name('schedule.edit');
	Route::post('/schedule', 'ScheduleController@store')->name('schedule.store');
});

Route::middleware('auth')->group(function(){
	Route::get('/appointments/create', 'AppointmentController@create')->name('appointments.create');
	Route::post('/appointments', 'AppointmentController@store')->name('appointments.store');

	//JSON
	Route::get('/specialties/{specialty}/doctors', 'Api\SpecialtyController@doctors')->name('specialties.doctors');
	Route::get('/schedule/hours', 'Api\ScheduleController@hours')->name('schedule.hours');
});

