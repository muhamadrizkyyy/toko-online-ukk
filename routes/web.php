<?php

use App\Http\Controllers\PaymentCallback;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\User\Form as UserForm;
use App\Http\Livewire\Admin\User\Table as UserTable;
use App\Http\Livewire\Admin\Category\Form as CategoryForm;
use App\Http\Livewire\Admin\Category\Table as CategoryTable;
use App\Http\Livewire\Admin\PaymentMethods\Form as PaymentMethodsForm;
use App\Http\Livewire\Admin\PaymentMethods\Table as PaymentMethodsTable;
use App\Http\Livewire\Admin\Product\Form as ProductForm;
use App\Http\Livewire\Admin\Product\Table as ProductTable;
use App\Http\Livewire\Admin\Report\Table as ReportTable;
use App\Http\Livewire\Admin\Transaction\Show as TransactionShow;
use App\Http\Livewire\Admin\Transaction\Table as TransactionTable;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\User\Cart\Checkout as CartCheckout;
use App\Http\Livewire\User\Cart\Table as CartTable;
use App\Http\Livewire\User\History\Detail;
use App\Http\Livewire\User\History\Table;
use App\Http\Livewire\User\Home;
use App\Http\Livewire\User\Product\Checkout as ProductCheckout;
use App\Http\Livewire\User\Product\Detail as ProductDetail;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", function () {
    return redirect()->route("home");
});

Route::get("/login", Login::class)->name("login");
Route::get("/logout", [Login::class, "logout"])->name("logout");
Route::get("/register", Register::class)->name("register");
Route::get("/home", Home::class)->name("home");
Route::get("/detail-product/{slug}", ProductDetail::class)->name("product.detail");
Route::post("/callback-notification", PaymentCallback::class)->name("callback-notification");


Route::middleware("auth")->group(function () {

    Route::prefix("admin")->middleware("isAdmin")->group(function () {
        Route::get("/", Dashboard::class)->name("dashboard.admin");
        Route::get("/user", UserTable::class)->name("users");
        Route::get("/user/create", UserForm::class)->name("users.create");
        Route::get("/user/{id}/edit", UserForm::class)->name("users.edit");

        Route::get("/category", CategoryTable::class)->name("category");
        Route::get("/category/create", CategoryForm::class)->name("category.create");
        Route::get("/category/{id}/edit", CategoryForm::class)->name("category.edit");

        Route::get("/product", ProductTable::class)->name("product");
        Route::get("/product/create", ProductForm::class)->name("product.create");
        Route::get("/product/{id}/edit", ProductForm::class)->name("product.edit");

        Route::get("/payment_method", PaymentMethodsTable::class)->name("payment_method");
        Route::get("/payment_method/create", PaymentMethodsForm::class)->name("payment_method.create");
        Route::get("/payment_method/{id}/edit", PaymentMethodsForm::class)->name("payment_method.edit");

        Route::get("/transaction", TransactionTable::class)->name("transaction");
        Route::get("/transaction/{id}/show", TransactionShow::class)->name("transaction.show");

        Route::get("/report", ReportTable::class)->name("report");
        Route::get("/report/view", [ReportTable::class, "print_view "])->name("report.print");
    });

    Route::get("/cart", CartTable::class)->name("cart");
    Route::get("/cart/checkout", CartCheckout::class)->name("cart.checkout");

    Route::get("/history", Table::class)->name("history");
    Route::get("/history/{id}/detail", Detail::class)->name("history.detail");

    Route::get("/product/checkout/{id}", ProductCheckout::class)->name("product.checkout");
});
