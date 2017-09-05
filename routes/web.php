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

// Route::get('/', function () {
// 	return view('welcome');
// });

Route::get('/', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'backend'], function () {
	

    Route::get('home', 'HomeController@index')->name('home');

    //Roles
    Route::get("roles", 'RoleController@index')->name("roles.index");
    Route::get("roles/create", 'RoleController@create')->name('roles.create');
    Route::post("roles/store", 'RoleController@store')->name('roles.store');
    Route::get("roles/data", 'RoleController@data')->name("roles.data");
    Route::get("roles/{id}/edit", 'RoleController@edit')->name('roles.edit');
    Route::patch("roles/update/{id}", 'RoleController@update')->name('roles.update');
    Route::post("roles/delete", 'RoleController@destroy')->name('roles.delete');

    //Users
    Route::get('users','UserController@index')->name("users.index");
    Route::get("users/create", 'UserController@create')->name('users.create');
    Route::post("users/store",'UserController@store')->name("users.store");
    Route::get("users/data", 'UserController@data')->name("users.data");
    Route::get('users/{id}/edit',"UserController@edit")->name('users.edit');
    Route::patch('users/update/{id}',"UserController@update")->name('users.update');
    Route::post('users/delete',"UserController@destroy")->name('users.delete');

     //Categories
    Route::get("categories", 'CategoryController@index')->name("categories.index");
    Route::get("categories/data", 'CategoryController@data')->name("categories.data");
    Route::get("categories/create", 'CategoryController@create')->name("categories.create");
    Route::post("categories/store", 'CategoryController@store')->name('categories.store');    
    Route::get("categories/{id}/edit", 'CategoryController@edit')->name('categories.edit');
    Route::post("categories/update/{id}", 'CategoryController@update')->name('categories.update');
    Route::post("categories/delete", 'CategoryController@destroy')->name('categories.delete'); 

    //Products
    Route::get("products", 'ProductController@index')->name("products.index");
    Route::get("products/create", 'ProductController@create')->name('products.create');
    Route::post("products/store", 'ProductController@store')->name('products.store');
    Route::get("products/data", 'ProductController@data')->name("products.data");
    Route::get("products/{id}/edit", 'ProductController@edit')->name('products.edit');
    Route::post("products/update/{id}", 'ProductController@update')->name('products.update');
    Route::post("products/delete", 'ProductController@destroy')->name('products.delete'); 

    //Customers
    Route::get('customers','CustomerController@index')->name("customers.index");
    Route::get("customers/create", 'CustomerController@create')->name('customers.create');
    Route::post("customers/store",'CustomerController@store')->name("customers.store");
    Route::get("customers/data", 'CustomerController@data')->name("customers.data");    
    Route::get('customers/{id}/edit',"CustomerController@edit")->name('customers.edit');
    Route::patch('customers/update/{id}',"CustomerController@update")->name('customers.update');
    Route::post('customers/delete',"CustomerController@destroy")->name('customers.delete');

    //Payments
    Route::get("payments", 'PaymentController@index')->name("payments.index");
    Route::get("payments/create", 'PaymentController@create')->name('payments.create');
    Route::post("payments/store", 'PaymentController@store')->name('payments.store');
    Route::get("payments/data", 'PaymentController@data')->name("payments.data");
    Route::get("payments/{id}/edit", 'PaymentController@edit')->name('payments.edit');
    Route::patch("payments/update/{id}", 'PaymentController@update')->name('payments.update');
    Route::post("payments/delete", 'PaymentController@destroy')->name('payments.delete');

    //Suppliers
    Route::get("suppliers", 'SupplierController@index')->name("suppliers.index");
    Route::get("suppliers/create", 'SupplierController@create')->name('suppliers.create');
    Route::post("suppliers/store", 'SupplierController@store')->name('suppliers.store');
    Route::get("suppliers/data", 'SupplierController@data')->name("suppliers.data");
    Route::get("suppliers/{id}/edit", 'SupplierController@edit')->name('suppliers.edit');
    Route::patch("suppliers/update/{id}", 'SupplierController@update')->name('suppliers.update');
    Route::post("suppliers/delete", 'SupplierController@destroy')->name('suppliers.delete');    

    //Sales
    Route::get("sales/complete", 'SaleController@complete')->name("sales.complete");
    Route::get("sales", 'SaleController@index')->name("sales.index");
    Route::post("sales/store", 'SaleController@store')->name('sales.store');
    Route::get("sales/data", 'SaleController@data')->name("sales.data");
    Route::get("sales/remove", 'SaleController@remove')->name("sales.remove");
    Route::get("salesload/data",'SaleLoadController@data')->name('salesload.data');
    Route::get("sales/allcategories",'AllCategoryController@data')->name('sales.allcategories');
    Route::get("sales/productbycategory",'AllProductController@data')->name('sales.allproduct');
    Route::get("sales/allproducts",'AllProductController@allproductsdata')->name('sales.allproductsdata');
    Route::post("sales/discard",'SaleController@discard')->name('sales.discard');
    Route::get("salesqualtity/data",'SaleQualityController@data')->name('salesqualtity.data');

    //Purchase
    Route::get("purchase", 'PurchaseController@index')->name("purchase.index");
    Route::get("purchase/data", 'PurchaseController@data')->name("purchase.data");
    Route::get("purchase/remove", 'PurchaseController@remove')->name("purchase.remove");
    Route::get("purchaseload/data",'PurchaseLoadController@data')->name('purchaseload.data');
    Route::post("purchase/store", 'PurchaseController@store')->name('purchase.store');
    Route::post("purchase/discard",'PurchaseController@discard')->name('purchase.discard');
    Route::get("purchasequaltity/data",'PurchaseQualityController@data')->name('purchasequaltity.data');
    Route::get("purchase/allproducts",'AllProductController@selectdata')->name('purchase.allproducts');
    Route::get("purchase/allcategories",'AllCategoryController@data')->name('purchase.allcategories');
     Route::get("purchase/productbycategory",'AllProductController@data')->name('purchase.allproduct');


    //Sale Report
    Route::get("salesreportbydate", 'SaleReportByDateController@index')->name("salesreportbydate.index");   
    Route::get("salesreportbydate/data", 'SaleReportByDateController@data')->name("salesreportbydate.data");
    Route::get("salesreportbydate/show/{id}", 'SaleReportByDateController@show')->name("salesreportbydate.show");

    //Purchase Report
    Route::get("purchasereportbydate", 'PurchaseReportByDateController@index')->name("purchasereportbydate.index");
    Route::get("purchasereportbydate/data", 'PurchaseReportByDateController@data')->name("purchasereportbydate.data");
    Route::get("purchasereportbydate/show/{id}", 'PurchaseReportByDateController@show')->name("purchasereportbydate.show");


    Route::get("purchase", 'PurchaseController@index')->name("purchase.index");

    Route::get("inventories", 'InventoryController@index')->name("inventories.index");
    Route::get("inventories/data", 'InventoryController@data')->name("inventories.data");
    Route::get("inventories/{id}/edit", 'InventoryController@edit')->name('inventories.edit');
    Route::get("inventories/show/{id}", 'InventoryController@show')->name('inventories.show');
    Route::post("inventories/update/{id}", 'InventoryController@update')->name('inventories.update');
    Route::get("inventories/databyproductID", 'InventoryController@databyproductID')->name("inventories.databyproductID");

});


