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
Route::get('/', 'HomeController@index')->name('home');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::get('/about','AboutController@index')->name('about'); 

Route::get('/categories', 'CategoryController@index')->name('categories');
Route::get('/categories/{id}', 'CategoryController@detail')->name('categories-detail');

Route::get('/details/{id}', 'DetailController@index')->name('detail');
Route::POST('/details/{id}', 'DetailController@add')->name('detail-add');

Route::get('/success', 'CartController@success')->name('success');
// Route::post('/checkout/callback', 'CheckoutController@callback')->name('midtrans-callback');
Route::get('/register/success', 'Auth\RegisterController@success')->name('register-success');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/cart', 'CartController@index')->name('cart');

    Route::post('/cart-dec/{id}','CartController@decrement')->name('dec');
    Route::post('/cart-in/{id}','CartController@increment')->name('in');
    
    Route::delete('/cart/{id}', 'CartController@delete')->name('cart-delete');

    Route::post('/checkout', 'CheckoutController@process')->name('checkout');

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/dashboard/products', 'DashboardProductController@index')
        ->name('dashboard-product');
    Route::get('/dashboard/products/create', 'DashboardProductController@create')
        ->name('dashboard-product-create');
    Route::post('/dashboard/products', 'DashboardProductController@store')
        ->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', 'DashboardProductController@details')
        ->name('dashboard-product-details');

    Route::POST('comentar-user','Admin\ProductController@comment')->name('commentar');
    
    Route::post('/dashboard/products/{id}', 'DashboardProductController@update')
        ->name('dashboard-product-update');

    Route::post('/dashboard/products/gallery/upload', 'DashboardProductController@uploadGallery')
        ->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', 'DashboardProductController@deleteGallery')
        ->name('dashboard-product-gallery-delete');

    Route::get('/dashboard/transactions', 'DashboardTransactionController@index')
        ->name('dashboard-transaction');
    Route::get('/dashboard/transactions/{id}', 'DashboardTransactionController@details')
        ->name('dashboard-transaction-details');
    Route::post('/dashboard/transactions/{id}', 'DashboardTransactionController@update')
        ->name('dashboard-transaction-update');

    Route::get('/dashboard/settings', 'DashboardSettingController@store')
        ->name('dashboard-settings-store');
    Route::get('/dashboard/account', 'DashboardSettingController@account')
        ->name('dashboard-settings-account');
    Route::post('/dashboard/update/{redirect}', 'DashboardSettingController@update')
        ->name('dashboard-settings-redirect');

});

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','admin'])
    ->group(function() {
        Route::get('/', 'DashboardController@index')->name('admin-dashboard');
        Route::resource('category', 'CategoryController');
        Route::resource('user', 'UserController');
        Route::resource('product', 'ProductController');
        Route::resource('product-gallery', 'ProductGalleryController');
        Route::resource('transaction', 'TransactionController');
    });

Auth::routes();

Route::get('storage/assets/category/{filename}', function($filename)
{

    $filePath = storage_path().'/app/public/assets/category/'.$filename;

    if ( ! File::exists($filePath) or ( ! $mimeType = getImageContentType($filePath)))
    {
        return Response::make("File does not exist.", 404);
    }

    $fileContents = File::get($filePath);

    return Response::make($fileContents, 200, array('Content-Type' => $mimeType));
});
Route::get('storage/assets/product/{filename}', function($filename)
{

    $filePath = storage_path().'/app/public/assets/product/'.$filename;

    if ( ! File::exists($filePath) or ( ! $mimeType = getImageContentType($filePath)))
    {
        return Response::make("File does not exist.", 404);
    }

    $fileContents = File::get($filePath);

    return Response::make($fileContents, 200, array('Content-Type' => $mimeType));
});

function getImageContentType($file)
{
    $mime = exif_imagetype($file);

    if ($mime === IMAGETYPE_JPEG) 
        $contentType = 'image/jpeg';

    elseif ($mime === IMAGETYPE_GIF)
        $contentType = 'image/gif';

    else if ($mime === IMAGETYPE_PNG)
        $contentType = 'image/png';

    else
        $contentType = false;

    return $contentType;
}

