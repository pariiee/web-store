<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Guest Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Guest\LandingController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\ProfileController;
use App\Http\Controllers\Guest\ProductViewController;
use App\Http\Controllers\Guest\CheckoutController;
use App\Http\Controllers\Guest\TransactionHistoryController as UserTransactionHistoryController;
use App\Http\Controllers\Guest\RedeemCodeController;
use App\Http\Controllers\Guest\BuktiGaransiController;
use App\Http\Controllers\Guest\InformationController;
use App\Http\Controllers\Guest\TransferController;
use App\Http\Controllers\Guest\TopBuyerController;
use App\Http\Controllers\TopupController;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\TransactionHistoryController as AdminTransactionHistoryController;
use App\Http\Controllers\Admin\RedeemController;
use App\Http\Controllers\Admin\MaintenanceController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('welcome');

Route::get('/price-list', [LandingController::class, 'priceList'])
    ->name('public.price-list');

Route::get('/p/{product:slug}', [ProductViewController::class, 'show'])
    ->name('product.show');


Route::post('/devtools-detected', function () {

    logger('DevTools detected', [
        'ip' => request()->ip(),
        'ua' => request()->userAgent(),
        'url' => request()->headers->get('referer'),
    ]);


    Http::post(
        "https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage",
        [
            'chat_id' => env('TELEGRAM_BOT_ADMIN'),
            'text' => "⚠️ DevTools Detected\n\nIP: " . request()->ip()
        ]
    );

    return response()->json(['ok' => true]);
})->middleware('throttle:5,1');

/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'maintenance'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('guest.home');

    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::post('/update', [ProfileController::class, 'updateProfile'])->name('update');
        Route::post('/password', [ProfileController::class, 'updatePassword'])->name('password');
        Route::post('/photo', [ProfileController::class, 'updatePhoto'])->name('photo');
    });

    Route::post('/p/{product:slug}/checkout', [CheckoutController::class, 'checkout'])
        ->name('product.checkout');

    Route::post('/checkout/{transaction}/confirm', [CheckoutController::class, 'confirm'])
        ->name('checkout.confirm');

    Route::get('/riwayat', [UserTransactionHistoryController::class, 'index'])
        ->name('transactions.history');

    Route::get('/redeem', [RedeemCodeController::class, 'index'])->name('redeem.index');
    Route::post('/redeem', [RedeemCodeController::class, 'redeem'])->name('redeem.store');

    Route::get('/information', [InformationController::class, 'index'])->name('information');

    Route::get('/top-buyers', [TopBuyerController::class, 'index'])
        ->name('top-buyers');

    Route::get('/bukti-garansi', [BuktiGaransiController::class, 'index'])
        ->name('bukti-garansi.index');

    Route::post('/bukti-login/store', [BuktiGaransiController::class, 'storeBuktiLogin'])
        ->name('bukti-login.store');

    Route::post('/klaim-garansi/store', [BuktiGaransiController::class, 'storeGaransi'])
        ->name('klaim-garansi.store');

    Route::prefix('transfer')->name('transfer.')->group(function () {
        Route::get('/', [TransferController::class, 'index'])->name('index');
        Route::get('/search', [TransferController::class, 'search'])->name('search');
        Route::get('/{id}', [TransferController::class, 'show'])->name('show');
        Route::post('/process', [TransferController::class, 'process'])->name('process');
        Route::get('/riwayat/history', [TransferController::class, 'history'])->name('history');
    });

    /*
    |--------------------------------------------------------------------------
    | TOPUP (RATE LIMITED)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['throttle:30,1'])->group(function () {

        Route::get('/topup', fn () => view('topup.index'))->name('topup');

        Route::post('/topup/create', [TopupController::class, 'createTopup'])
            ->name('topup.create');

        Route::get('/topup/payment/{id}', [TopupController::class, 'showPayment'])
            ->name('topup.payment');

        Route::get('/topup/check/{id}', [TopupController::class, 'checkStatus'])
            ->name('topup.check');

        Route::post('/topup/cancel/{id}', [TopupController::class, 'cancelPayment'])
            ->name('topup.cancel');
    });
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::post('/maintenance-toggle', [MaintenanceController::class, 'toggle'])
            ->name('maintenance.toggle');

        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('products', ProductController::class)->except(['show']);
        Route::resource('items', ItemController::class)->except(['show']);

        Route::get('/items/product/{product}', [ItemController::class, 'showProduct'])
            ->name('items.product.show');

        Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');
        Route::get('/stocks/create/{item}', [StockController::class, 'create'])->name('stocks.create');
        Route::post('/stocks/store/{item}', [StockController::class, 'store'])->name('stocks.store');
        Route::get('/stocks/show/{item}', [StockController::class, 'show'])->name('stocks.show');
        Route::delete('/stocks/{stock}', [StockController::class, 'destroy'])->name('stocks.destroy');

        Route::get('/manage-users', [UserManagementController::class, 'index'])->name('manage-users');
        Route::put('/manage-users/{user}/role', [UserManagementController::class, 'updateRole'])->name('users.updateRole');
        Route::put('/manage-users/{user}/balance', [UserManagementController::class, 'updateBalance'])->name('users.updateBalance');
        Route::put('/manage-users/{user}/password', [UserManagementController::class, 'updatePassword'])->name('users.updatePassword');
        Route::delete('/manage-users/{user}/delete', [UserManagementController::class, 'destroy'])->name('users.destroy');

        Route::post('/manage-users/{user}/reset-username-timer', [UserManagementController::class, 'resetUsernameTimer'])
            ->name('users.resetUsernameTimer');

        Route::post('/manage-users/{user}/reset-password-timer', [UserManagementController::class, 'resetPasswordTimer'])
            ->name('users.resetPasswordTimer');

        Route::put('/manage-users/{user}/edit-data', [UserManagementController::class, 'updateData'])
            ->name('users.updateData');

        Route::get('/manage-users/{user}/point-details', [UserManagementController::class, 'getPointDetails'])
            ->name('users.pointDetails');

        Route::get('/deleted-users', [UserManagementController::class, 'deletedUsers'])->name('users.deleted');
        Route::patch('/users/{id}/restore', [UserManagementController::class, 'restore'])->name('users.restore');
        Route::delete('/users/{id}/force-delete', [UserManagementController::class, 'forceDestroy'])->name('users.force-delete');

        Route::post('/users/trigger-auto-delete', [UserManagementController::class, 'triggerAutoDelete'])
            ->name('users.trigger-auto-delete');

        Route::get('/transactions', [AdminTransactionHistoryController::class, 'index'])
            ->name('transactions.index');

        Route::resource('redeem', RedeemController::class)->except(['edit', 'update']);

        Route::get('/manage-users/search', [UserManagementController::class, 'search'])
            ->name('users.search');
    });

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (BREEZE)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
