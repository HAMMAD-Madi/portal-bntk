<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\AuthController;



// Login
Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login'])->name('login.post');
// Logout
Route::get('/logout', [AuthController::class,'logout'])->name('logout');


Route::get('/check-product', [ProductController::class, 'check_product'])->name('check-product');
// Route::get('/scan-feature', [ProductController::class, 'scanFeature']);
Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::get('/home', [HomeController::class, 'index'])->middleware('auth');
Route::get('/scan-feature', [ProductController::class, 'scanFeature'])->middleware('auth');
Route::post('/scan-feature-save', [ProductController::class, 'scanFeatureSave'])->name('scanFeatureSave');

Route::get('/all-orders', [OrderController::class, 'orders'])->middleware('auth');
Route::get('/order-detail/{any}', [OrderController::class, 'order_detail'])->middleware('auth');
// Route::get('/mark-as-paid/{any}', [OrderController::class, 'mark_as_paid'])->name('mark-as-paid')->middleware('auth');
Route::post('/orders/{id}/mark-as-next-status', [OrderController::class, 'mark_as_next_status'])->name('orders.markAsNextStatus')->middleware('auth');


Route::get('/all-shippings', [ShippingController::class, 'shippings'])->middleware('auth');
Route::get('/shipping-detail/{any}', [ShippingController::class, 'shipping_detail'])->middleware('auth');

Route::post('/approve-return', [ShippingController::class, 'approveReturn'])->name('approve-return')->middleware('auth');
Route::post('/reject-return', [ShippingController::class, 'rejectReturn'])->name('reject-return')->middleware('auth');

Route::get('/get-shipping-options', [ShippingController::class, 'get_shipping_options'])->name('get-shipping-options')->middleware('auth');
Route::get('/create-shipping-label', [ShippingController::class, 'create_shipping_label'])->name('create-shipping-label')->middleware('auth');

Route::get('/download-sendcloud-pdf/{any}', [ShippingController::class, 'download_sendcloud_pdf'])->name('download-sendcloud-pdf')->middleware('auth');


Route::post('/orders/change-status/{status}', [OrderController::class, 'change_status'])->name('orders.changeStatus')->middleware('auth');
Route::post('/shipping-detail/update-marketplace-order', [OrderController::class, 'update_track_or_trace_code_order'])->name('update.marketplace.order')->middleware('auth');

Route::get('/overview', [OverviewController::class, 'index'])->middleware('auth');
Route::post('/update-product/{any}', [ProductController::class, 'update_from_overview_page'])->middleware('auth')->name('update-product');
Route::post('/add-product', [ProductController::class, 'add_from_overview_page'])->middleware('auth')->name('add-product');
Route::post('/update-stock/{any}', [ProductController::class, 'update_stock_from_overview_page'])->middleware('auth')->name('update-stock');

Route::post('/send-to-webhook', [ProductController::class, 'sendToWebhookForPostRequest'])->middleware('auth')->name('send-to-webhook');

// Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
// Route::get('/logout', [LoginController::class, 'logout']);

Route::get('/{any}', function () {
    return view('app');
})->where('any', '^(?!(api|werkorder|auth|storage|phpdb)).*$')->middleware('cache.headers:public;max_age=2628000;etag')->name('index');

Route::post('/update-location', [ProductController::class, 'updateLocation'])->name('update-location');
Route::post('/update-retired', [ProductController::class, 'updateRetired'])->name('update-retired');
Route::post('/update-lock-price', [ProductController::class, 'updateLockPrice'])->name('update-lock-price');