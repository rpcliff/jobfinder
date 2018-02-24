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

/*
 *      PAGE ROUTES
 */
Route::get('/', 'PageController@index')->name('home');

Route::get('/companies', 'PageController@companies')->name('companies');

Route::get('/job_openings', 'PageController@job_openings')->name('job_openings');


/*
 *      PROFILE ROUTES
 */
Route::get('/profile/{user_id}', 'ProfileController@show');

Route::get('/profile/{user_id}/edit', 'ProfileController@edit');

Route::patch('/profile/{user_id}/edit', 'ProfileController@update');

Route::get('/profile/{user_id}/edit_skills', 'ProfileController@edit_skills');

Route::patch('/profile/{user_id}/edit_skills', 'ProfileController@update_skills');

Route::get('/profile/{user_id}/edit_experience', 'ProfileController@edit_experience');

Route::patch('/profile/{user_id}/edit_experience', 'ProfileController@update_experience');

Route::post('/profile/{user_id}/add_experience', 'ProfileController@add_experience');

Route::delete('/profile/{user_id}/experience/{experience_id}/delete', 'ProfileController@delete_experience');

Route::get('/profile/{user_id}/edit_education', 'ProfileController@edit_education');

Route::post('/profile/{user_id}/add_education', 'ProfileController@add_education');


/*
 *      DASHBOARD ROUTES
 */
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::get('/applications', 'DashboardController@applications');

Route::get('/company_jobs', 'DashboardController@company_jobs');


/*
 *      JOB ROUTES
 */
Route::get('/job/{job_id}', 'JobController@show');

Route::get('/create_job', 'JobController@show_create');

Route::post('/job/create', 'JobController@create');

Route::get('/job/{job_id}/manage', 'JobController@manage');

Route::get('/job/{job_id}/apply', 'JobController@apply');


/*
 *      AUTH ROUTES
 */
Route::get('/login', 'AuthController@index');

Route::post('/login', 'AuthController@login')->name('login');

Route::post('/register', 'AuthController@register');

Route::get('/logout', 'AuthController@logout');


/*
 *      ADMIN ROUTES
 */
Route::get('/admin', 'AdminController@index')->name('admin');

Route::get('/admin/skills', 'AdminController@skills');

Route::get('/admin/all_users', 'AdminController@all_users');

Route::get('/admin/seekers', 'AdminController@seekers');