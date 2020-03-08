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

Route::get('/', function () {
    return redirect()->route('login');
}); 

Auth::routes(['verify' => true]);



// home////////////////////////////////////////////////////////////////////////////
Route::get('/home', 'HomeController@index')->name('home');
// employee//////////
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/add_employee', 'employeecontroller@add_employee')->name('add_employee');
Route::get('/all_employee', 'employeecontroller@all_employee')->name('all_employee');



// insert_employee//////////////////////////////////////////////////////////////////////////////////
Route::post('/insert_employee', 'employeecontroller@insert_employee');
// delete employee and view/////////////////////////////
Route::get('/delete_employee/{id}', 'employeecontroller@delete_employee');
Route::get('/view_employee/{id}', 'employeecontroller@view_employee');
// edit info////////////////////////////////////////////////
Route::get('/edit_info/{id}', 'employeecontroller@edit_info');
// update employee////////////////////////////////////////////
Route::post('/update_employee/{id}', 'employeecontroller@update_employee');



// customer area////////////////////////////////////////////////////////////////
Route::get('/add_customer', 'customercontroller@add_customer')->name('add_customer');
Route::get('/all_customer', 'customercontroller@all_customer')->name('all_customer');
Route::post('/insert_customer', 'customercontroller@insert_customer');
Route::get('/delete_customer/{id}', 'customercontroller@delete_customer');
Route::get('/view_customer/{id}', 'customercontroller@view_customer');
Route::get('/edit_customer/{id}', 'customercontroller@edit_customer');
Route::post('/update_customer/{id}', 'customercontroller@update_customer');



// supplier area Here////////////////////////////////////////////////////////////////
Route::get('/add_supplier', 'suppliercontroller@add_supplier')->name('add_supplier');
Route::get('/all_supplier', 'suppliercontroller@all_supplier')->name('all_supplier');

Route::post('/insert_supplier', 'suppliercontroller@insert_supplier');

Route::get('/view_supplier/{id}', 'suppliercontroller@view_supplier');

Route::get('/delete_supplier/{id}', 'suppliercontroller@delete_supplier');

Route::get('/edit_supplier/{id}', 'suppliercontroller@edit_supplier');

Route::post('/update_supplier/{id}', 'suppliercontroller@update_supplier');
// salary area is here//////////////////////////////////////////////////////////////////
Route::get('/add_salary', 'salarycontroller@add_salary')->name('add_salary');
Route::get('/all_salary', 'salarycontroller@all_salary')->name('all_salary');
Route::post('/insert_advancedsalary', 'salarycontroller@insert_advancedsalary');
Route::get('/pay_salary', 'salarycontroller@pay_salary')->name('pay_salary');


// categories route are here///////////////////////////////////////////////////////////

Route::get('/add_category', 'categorycontroller@add_category')->name('add_category');

Route::get('/all_category', 'categorycontroller@all_category')->name('all_category');
Route::post('/insert_category', 'categorycontroller@insert_category');
Route::get('/delete_category/{id}', 'categorycontroller@delete_category');
Route::get('/edit_category/{id}', 'categorycontroller@edit_category');

Route::post('/update_category/{id}', 'categorycontroller@update_category');

// products route is here///////////////////////////////////////////////////////////////



Route::get('/add_product', 'productsControoler@add_product')->name('add_product');

Route::get('/all_product', 'productsControoler@all_product')->name('all_product');
Route::post('/insert_product', 'productsControoler@insert_product');
Route::get('/delete_product/{id}', 'productsControoler@delete_product');
Route::get('/view_product/{id}', 'productsControoler@view_product');

Route::get('/edit_product/{id}', 'productsControoler@edit_product');
Route::post('/update_product/{id}', 'productsControoler@update_Product');






















Route::group(['middleware'=>'verified'],function(){



Route::get('inbox', function () {
   echo "inbox";
})->name('inbox');


});