<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\languageController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\NotificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
//logout  

Route::get('/employee/logout',[RedirectController::class ,'Logout'])->name('employee.logout');

//properties
Route::get('/create',[PropertyController::class ,'create'])->name('property.create.page');

Route::get('/{id}/property',[PropertyController::class ,'show'])->name('property.show');

Route::post('/store',[PropertyController::class ,'store'])->name('property.store'); 

Route::delete('/deleteProperty/{id}',[PropertyController::class ,'destroy'])->name('property.destroy');

//Redirect

Route::get('/dashbard',[RedirectController::class ,'dashboard'])->name('dashboard.page');

Route::get('/notification',[RedirectController::class ,'notification'])->name('notification.page');

Route::get('/list/properties',[RedirectController::class ,'properties'])->name('properties.page');



Route::resource('requests', RequestController::class);

Route::get('/clients/apply-action', [RequestController::class, 'thank_you'])->name('requests.thank_you');
Route::post('/clients/apply-action', [RequestController::class, 'applyAction'])->name('requests.applyAction');
Route::post('/clients/apply-time', [RequestController::class, 'applyTime'])->name('requests.applyTime');

//notifications 

// routes/web.php

Route::post('/{id}/mark-as-read', [RequestController::class, 'markAsRead'])->name('notification.markAsRead');


Route::get('/sendsms',[SmsController::class, 'sendsms']);


Route::get('lang/{locale}', [LanguageController::class, 'swap'])->name('language.switch'); 



Route::get('/properties/{id}/edit', [PropertyController::class, 'edit'])->name('property.edit');

Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');



Route::get('fullcalender', [EventController::class, 'index']);

Route::post('fullcalenderAjax', [EventController::class, 'ajax']);




});


