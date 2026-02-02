<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Models\User;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BolcomInvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShippingPackageController;
use App\Http\Controllers\StockLocationController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return User::with('deployments')->find(Auth::id());
});

Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::post('/shipping-detail/update-marketplace-order', [OrderController::class, 'update_track_or_trace_code_order'])->name('update.marketplace.order');

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('countries', [InvoiceController::class, 'countries']);

    Route::get('contacts', [ContactController::class, 'index']);
    Route::put('contacts', [ContactController::class, 'update']);
    Route::post('contacts', [ContactController::class, 'store']);
    Route::delete('contacts/{id}', [ContactController::class, 'delete']);

    Route::post('categories', [CategoryController::class, 'store']);
    Route::get('categories', [CategoryController::class, 'index']);
    Route::get('categories2/children', [CategoryController::class, 'listchildren']);
    Route::get('categories/nieuw', [CategoryController::class, 'create']);
    Route::get('categories/{id}', [CategoryController::class, 'show']);

    Route::get('categorylist', [CategoryController::class, 'list']);
    Route::get('getcategories', [CategoryController::class, 'getcategories']);
    Route::get('exportproducts', [ProductController::class, 'exportproducts']);
    Route::post('product', [ProductController::class, 'store']);
    Route::post('product/quantity', [ProductController::class, 'quantity']);
    Route::get('generate-ean', [ProductController::class, 'generateEan']);
    Route::get('product/search', [ProductController::class, 'search']);
    Route::post('product/notify', [ProductController::class, 'updateNotify']);
    Route::get('product/{gtin}', [ProductController::class, 'show']);
    Route::post('product/{gtin}', [ProductController::class, 'update']);
    //Route::get('categories', [ProductController::class, 'categories']);
    Route::get('product', [ProductController::class, 'index']);
    Route::get('colors', [ProductController::class, 'colors']);
    Route::get('phpinfo', [ProductController::class, 'phpinfo']);
    Route::get('generateproductgtin', [ProductController::class, 'generateGtin']);
    Route::delete('product/{gtin}', [ProductController::class, 'destroy']);
    Route::get('findproduct/{gtin}', [ProductController::class, 'find']);


    // Bol.com invoice requests
    Route::get('invoice_requests/{orderId}/download', [BolcomInvoiceController::class, 'download']);

    Route::get('invoice_requests', [BolcomInvoiceController::class, 'index']);

    Route::get('invoice_requests/{orderId}', [BolcomInvoiceController::class, 'show']);


    // sale invoices
    Route::get('downloadinvoice/{number}', [InvoiceController::class, 'downloadpdf']);
    Route::get('invoices', [InvoiceController::class, 'index']);
    Route::put('invoices/{number}', [InvoiceController::class, 'update']);
    Route::get('invoices/{number}', [InvoiceController::class, 'show']);
    Route::delete('invoices/{id}', [InvoiceController::class, 'delete']);
    Route::post('invoices', [InvoiceController::class, 'store']);


    // orders

    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{order_id}', [OrderController::class, 'show']);
    Route::post('shippinglabel', [OrderController::class, 'shippinglabel']);
    Route::post('/products/batch-upload', [ProductController::class, 'batchUpload']);
    Route::post('products/bulk-update-stock', [ProductController::class, 'bulkUpdateStock']);
    Route::post('products/bulk-update-location', [ProductController::class, 'bulkUpdateLocation']);


    Route::prefix('shipping-packages')->group(function () {
        Route::get('/', [ShippingPackageController::class, 'index']);
        Route::post('/', [ShippingPackageController::class, 'store']);
        Route::patch('/{id}/status', [ShippingPackageController::class, 'updateStatus']);
        Route::post('/{id}/return', [ShippingPackageController::class, 'returnToInventory']);
    });

    Route::prefix('stock-locations')->group(function () {
        Route::get('/', [StockLocationController::class, 'index']);
        Route::post('/', [StockLocationController::class, 'store']);
        Route::put('/{id}', [StockLocationController::class, 'update']);
        Route::delete('/{id}', [StockLocationController::class, 'destroy']);
    });

    // Investment routes
    Route::prefix('products')->group(function () {
        Route::get('/investment', [ProductController::class, 'getInvestmentItems']);
        Route::patch('/{id}/convert-to-regular', [ProductController::class, 'convertToRegular']);
        Route::patch('/{id}/investment-details', [ProductController::class, 'updateInvestmentDetails']);
    });
});