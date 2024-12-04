<?php
use App\Http\Controllers\AdminSupportController;
use App\Http\Controllers\EndkonArizaController;
use App\Http\Controllers\EntegreController;
use App\Http\Controllers\GeneratePdfController;
use App\Http\Controllers\KumesController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CaretakerController;
use App\Http\Controllers\EndkonDataController;
use App\Http\Controllers\MyAccountController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\KumesDashboardController;

use App\Http\Controllers\Caretaker\KumesController as CaretakerKumesController;
use App\Http\Controllers\Caretaker\ArizaController;
use App\Http\Controllers\Caretaker\DataController;

use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\Manager\EmployeesController;
use App\Http\Controllers\Manager\KumesController as ManagerKumesController;
use App\Http\Controllers\Manager\DataController as ManagerDataController;
use App\Http\Controllers\Manager\AlarmController as ManagerAlarmController;
use App\Http\Controllers\Manager\SupportController as ManagerSupportController;
Route::get('/', function () {
    return view('auth.login');
});


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// Rol tabanlı yönlendirmeler
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin_dashboard');
    Route::resource('admin_support',AdminSupportController::class);
    Route::resource('admin_log',LogController::class);
    
});

Route::middleware(['auth', 'role:bakıcı'])->group(function () {
    Route::get('/bakıcı/dashboard', [CaretakerController::class, 'index'])->name('bakici_dashboard');
    Route::resource('bakici_alarm', ArizaController::class);
    Route::resource('bakici_veri', DataController::class);
    
});

Route::middleware(['auth', 'role:yönetici'])->group(function () {
    Route::get('/yönetici/dashboard', [ManagerController::class, 'index'])->name('manager_dashboard');//yönetici
    Route::resource('manager_kumes',ManagerKumesController::class);
    Route::resource('manager_data',ManagerDataController::class);
    Route::resource('manager_alarm',ManagerAlarmController::class);
    Route::resource('manager_employees',EmployeesController::class);
    Route::resource('manager_support',ManagerSupportController::class);
});
/*
Route::middleware(['auth', 'role:veterinarian'])->group(function () {
    Route::get('/veterinarian/dashboard', [VeterinarianController::class, 'index']);//veteriner
});
*/
Route::resource('endkon_data', EndkonDataController::class);
Route::post('/sensordata', [EndkonDataController::class, 'store']);
//Route::get('/sensordata', [EndkonDataController::class, 'datareturn']);
Route::resource('kumes_data', EndkonDataController::class);
Route::resource('entegreler' , EntegreController::class);
Route::resource('kumes'      , KumesController::class);
Route::resource('user'       , UserController::class);
Route::resource('myaccount'       , MyAccountController::class);
Route::resource('ariza'       , EndkonArizaController::class);
Route::resource('notifications'       , NotificationController::class);

Route::get('kumes/create/{id}', [KumesController::class, 'create'])->name('kumes.create');
Route::get('/kumes/gosterge/{id}', [EndkonDataController::class, 'kumes_gosterge'])->name('kumes.gosterge');
Route::get('/kumes/dashboard/{id}', [KumesDashboardController::class, 'index'])->name('kumes.dashboard');
Route::get('/kumes/{id}/chart-data', [KumesDashboardController::class, 'getData'])->name('kumes.chart-data');
Route::get('/kumes/{id}/food-data', [KumesDashboardController::class, 'foodData'])->name('kumes.food-data');
Route::get('/kumes/{id}/os-data', [KumesDashboardController::class, 'osData'])->name('kumes.os-data');
Route::get('/kumes/{id}/isi-data', [KumesDashboardController::class, 'isiData'])->name('kumes.isi-data');
Route::get('/kumes/{id}/di-data', [KumesDashboardController::class, 'diData'])->name('kumes.di-data');
Route::get('/kumes/{id}/nem-data', [KumesDashboardController::class, 'nemData'])->name('kumes.nem-data');
Route::get('/kumes/{id}/co-data', [KumesDashboardController::class, 'coData'])->name('kumes.co-data');
Route::get('/kumes/{id}/ortak-data', [KumesDashboardController::class, 'ortakData'])->name('kumes.ortak-data');


Route::post('/messages/{id}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');



Route::get('/expired', function () {
    return view('layout.expired'); // layout.expired view dosyasına yönlendirilir
})->name('expired');

Route::get('generate-pdf/{id}', [GeneratePdfController::class, 'generatePDF'])->name('generate-pdf');
Route::get('/export-endkon-data/{kumesId}', [EndkonDataController::class, 'exportExcel'])->name('export.endkon.data');