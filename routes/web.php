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
//login routes
Route::get('/login', 'LoginController@index')->name('login.index');
Route::post('/login', 'LoginController@authenticated');
Route::get('/logout', 'LoginController@SignOut')->name('logout.index');

//middleware for check login
Route::group(['middleware' => ['login']], function () {

    //Dashboard
    Route::get('/', 'HomeController@index')->name('home.index');

    //point of sale
    Route::get('pointofsale/', 'PointOfSaleController@index')->name('pointofsale.index');
    Route::post('pointofsale/searchlive', 'PointOfSaleController@liveSearchMedicine')->name('pointofsale.liveSearch');
    Route::post('pointofsale/search/medicine', 'PointOfSaleController@medicinSearch')->name('pointofsale.searchMedicine');


    //purchase Medicine
    Route::get('purchasemedicine/', 'PurchaseController@index')->name('purchase.index');
    Route::post('purchasemedicine/searchlive', 'PurchaseController@liveSearchMedicine')->name('purchase.liveSearch');
    Route::post('purchasemedicine/search/medicine', 'PurchaseController@medicinSearch')->name('purchase.searchMedicine');


    //invoice routes
    Route::post('/invoice', 'InvoiceController@addtocart')->name('invoice.add');
    Route::post('/invoice/save', 'InvoiceController@saveInvoice')->name('invoice.save');
    Route::get('/invoice/{id}', 'InvoiceController@deleteInvoiceItem')->name('invoice.delete');
    Route::get('/invoice/add-new-invoice', 'InvoiceController@addNewInvoice')->name('invoice.addNewInvoice');

    //Manage Category
    Route::get('/Category/', 'CategoryController@index')->name('Category.index')->middleware('checkAdmin');
    Route::get('/Category/create', 'CategoryController@create')->name('Category.create')->middleware('checkAdmin');
    Route::post('/Category', 'CategoryController@store')->name('Category.store')->middleware('checkAdmin');
    Route::get('/Category/edit/{id}', 'CategoryController@edit')->name('Category.edit')->middleware('checkAdmin');
    Route::patch('/Category/{id}', 'CategoryController@update')->name('Category.update')->middleware('checkAdmin');
    Route::get('/Category/destroy', 'CategoryController@destroy')->name('Category.destroy')->middleware('checkAdmin');

    //Manage Medicine
    Route::get('/medicine/list', 'MedicineController@index')->name('medicine.index');
    Route::get('/medicine/create', 'MedicineController@create')->name('medicine.create');
    Route::post('/medicine/store', 'MedicineController@store')->name('medicine.store');
    Route::get('/medicine/destroy', 'MedicineController@destroy')->name('medicine.destroy');
    Route::get('/medicine/edit/{id}', 'MedicineController@edit')->name('medicine.edit');
    Route::post('/medicine/{id}', 'MedicineController@update')->name('medicine.update');
    Route::get('/medicine/shortage', 'MedicineController@shortage')->name('medicine.shortage');
    Route::get('/medicine/details/{id}', 'MedicineController@details')->name('medicine.details');
    Route::get('/medicine/expired', 'MedicineController@expired')->name('medicine.expired');
    Route::get('/medicine/nearexpired', 'MedicineController@nearExpired')->name('medicine.nearexpired');
    Route::get('/medicine-quantity-update-form/{id}','MedicineController@medicineUpdateForm')->name('medicine.quantity.form');
    Route::post('/medicine-quantity-update/{id}','MedicineController@updateMedicineQuantity')->name('quantity.update');

    //Manage Executives
    Route::resource('executive', 'ExecutiveController')->middleware('checkAdmin');
    Route::post('/executive/{id}', 'ExecutiveController@update')->name('executive.update')->middleware('checkAdmin');

    //Settings
    Route::get('/setting/activitylog', 'SettingController@activityLog')->name('setting.activity')->middleware('checkAdmin');
    Route::get('/setting/remainder', 'SettingController@remainderSetting')->name('setting.remainder')->middleware('checkAdmin');
    Route::post('/setting/remainder', 'SettingController@remainderChange')->name('setting.update')->middleware('checkAdmin');

    Route::get('/medicine/search', 'MedicineController@searchByGenericOrClassName')->name('medicine.search');

    //Manage Expenses catagory
    Route::get('/expense-category', 'ExpensecategoryController@index')->name('expense-category.index')->middleware('checkAdmin');
    Route::get('/expense-category/create', 'ExpensecategoryController@create')->name('expense-category.create')->middleware('checkAdmin');
    Route::post('/expense-category', 'ExpensecategoryController@store')->name('expense-category.store')->middleware('checkAdmin');
    Route::get('/expense-category/{id}', 'ExpensecategoryController@edit')->name('expense-category.edit')->middleware('checkAdmin');
    Route::patch('/expense-category/{id}', 'ExpensecategoryController@update')->name('expense-category.update')->middleware('checkAdmin');
    Route::get('/destory-expense-category', 'ExpensecategoryController@destroy')->name('expense-category.destroy')->middleware('checkAdmin');

    //expense related route
    Route::resource('expense', 'ExpenseController');

    //Manage Supplier
    Route::resource('supplier', 'SupplierController');
    Route::post('/supplier/{id}', 'SupplierController@update')->name('supplier.update')->middleware('checkAdmin');
    Route::get('/delete-supplier', 'SupplierController@delete')->name('supplier.delete')->middleware('checkAdmin');
    Route::get('/supplier/details', 'SupplierController@details')->name('supplier.details')->middleware('checkAdmin');


    //report related routes
    Route::get('/report/salesitems', 'SalesItemsController@index')->name('salesitem.index')->middleware('checkAdmin');
   // Route::get('/report/date-wise-invoices-index','SalesItemsController@dateWiseInvoiceIndex')->name('datewise.index')->middleware('checkAdmin');

    Route::get('/report/date-wise-invoices-list', 'InvoiceController@dateWiseInvoiceReport')->name('datewise.Invoices')->middleware('checkAdmin');
    Route::get('/report/invoice-details/{invoice_number}', 'SalesItemsController@invoiceDetails')->name('invoice.details')->middleware('checkAdmin');
    Route::get('/report/top-selling-product', 'SalesItemsController@topSellingProduct')->name('report.topSellingProduct')->middleware('checkAdmin');



});
