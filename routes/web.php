<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CalendarController;
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

//clients
Route::get('/index', [ClientController::class ,'index'])->name('clients.index');

Route::get('/show/{id}', [ClientController::class ,'show'])->name('clients.show');

Route::get('/create/client', [ClientController::class ,'create'])->name('create.client');

Route::get('/thank_you/client', [ClientController::class ,'thank_you'])->name('clients.thank_you');

Route::post('/store/client', [ClientController::class ,'store'])->name('client.store');

Route::get('/', function () {

    

    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware('auth')->group(function () {
//logout  
Route::resource('todo', TodoController::class);

Route::get('/employee/logout',[RedirectController::class ,'Logout'])->name('employee.logout');

//properties
Route::get('/create',[PropertyController::class ,'create'])->name('property.create.page');

Route::get('/createdraw',[PropertyController::class ,'createdraw'])->name('property.createdraw');

Route::get('/{id}/property',[PropertyController::class ,'show'])->name('property.show');

Route::post('/store',[PropertyController::class ,'store'])->name('property.store'); 
Route::post('/storeDraw',[PropertyController::class ,'storeDraw'])->name('property.store.draw'); 

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



Route::get('fullcalender', [EventController::class, 'index'])->name('calender.index');

Route::post('fullcalenderAjax', [EventController::class, 'ajax'])->name('calendar.ajax');

Route::post('calender/store', [EventController::class, 'storeEvent'])->name('calendar.event.store');
Route::post('event/mark-read/{id}', [EventController::class, 'markAsRead'])->name('event.mark-read');

Route::resource('/files',FilesController::class);
Route::get('/images', [FilesController::class, 'image'])->name('image.files');
Route::get('/video', [FilesController::class, 'video'])->name('video.files');
Route::post('/todos/update-status', [ToDoController::class, 'updateStatus'])->name('todos.update-status');



Route::get('/map',[PropertyController::class, 'map'])->name('property.map');
});



