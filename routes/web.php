<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\GroupMemberController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\SettingController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BedController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\AllocatedBedController;

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
Route::any('/', function () {
    return redirect('/login');
})->name('home');

Auth::routes();

Route::name('admin.')->prefix('admin')->middleware(['client'])->group(function () {
    Route::resource('setting', SettingController::class);
    Route::resource('role', RoleController::class);
    Route::get('report', [ReportController::class, 'index'])->name('report');
    Route::get('/', [HomeController::class, 'index'])->name('admin');

    // Places Routes
    Route::name('place.')->prefix('place')->middleware(['role:admin|reception'])->group(function () {
        Route::get('/', [PlaceController::class, 'list'])->name('list');
        Route::get('create', [PlaceController::class, 'create'])->name('create');
        Route::post('create', [PlaceController::class, 'store'])->name('create');
        Route::get('/{id}/edit', [PlaceController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [PlaceController::class, 'update'])->name('update');
        Route::post('/{id}/delete', [PlaceController::class, 'delete'])->name('delete');
        Route::get('/{id}/rooms', [PlaceController::class, 'rooms'])->name('rooms');

        //Rooms Routes

        Route::name('rooms.')->prefix('/{place}/room')->group(function () {
            Route::get('/', [RoomController::class, 'placeRoomList'])->name('list');
            Route::get('/create', [RoomController::class, 'create'])->name('create');
            Route::post('/create', [RoomController::class, 'store'])->name('create');
            Route::get('/{id}/edit', [RoomController::class, 'edit'])->name('edit');
            Route::post('/{id}/edit', [RoomController::class, 'update'])->name('update');
            Route::post('/{id}/delete', [RoomController::class, 'delete'])->name('delete');


        });
        Route::get('/room/{id}/beds', [RoomController::class, 'beds'])->name('rooms.beds');
        Route::get('/room/{id}/allbeds', [RoomController::class, 'allbeds'])->name('rooms.allbeds');

        Route::get('/{place}/room/{room}/bed', [BedController::class, 'RoomBedsList'])->name('rooms.beds.list');
        Route::post('/{place}/room/{room}/bed/create', [BedController::class, 'create'])->name('rooms.beds.create');
        Route::get('/{place}/room/{room}/bed/{bed}/edit', [BedController::class, 'edit'])->name('rooms.beds.edit');
        Route::post('/{place}/room/{room}/bed/{bed}/edit', [BedController::class, 'update'])->name('rooms.beds.update');
        Route::post('/{place}/room/{room}/bed/{bed}/delete', [BedController::class, 'delete'])->name('rooms.beds.delete');
    });

    Route::prefix('user')->group(function () {
        Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
        Route::get('create', [UserController::class, 'create'])->name('user.create');
        Route::post('create', [UserController::class, 'createUser'])->name('user.create');
    });

    Route::prefix('reception')->middleware(['role:admin|reception'])->group(function () {
        Route::get('/list', [AllocatedBedController::class, 'receptionList'])->name('reception.list');
        Route::get('/cart/{reception}', [AllocatedBedController::class, 'receptionCart'])->name('reception.cart');
        Route::get('/{gender}', [AllocatedBedController::class, 'getFreeRooms'])->name('reception.create');
        Route::post('/get_free_beds/{gender}', [AllocatedBedController::class, 'getFreeRooms'])->name('reception.getFreeBeds');
        Route::post('/{gender}', [AllocatedBedController::class, 'allocateBedToPerson'])->name('reception.allocatedToPerson');
        Route::get('/place/{place}/room/{room}/bed/{bed}', [AllocatedBedController::class, 'showFormReception'])->name('reception.showForm');

        Route::get('/{reception}/edit', [AllocatedBedController::class, 'receptionEdit'])->name('reception.edit');
        Route::post('/{reception}/clearance', [AllocatedBedController::class, 'receptionClearance'])->name('reception.clearance');

    });

    Route::prefix('servant')->middleware(['role:admin|reception'])->group(function () {
        Route::get('/', [ServantController::class, 'list'])->name('servant.list');
        Route::get('/create', [ServantController::class, 'create'])->name('servant.create');
        Route::post('/create', [ServantController::class, 'store'])->name('servant.create');
        Route::get('/edit/{id}', [ServantController::class, 'edit'])->name('servant.edit');
        Route::post('/edit/{id}', [ServantController::class, 'update'])->name('servant.update');
        Route::post('/delete/{id}', [ServantController::class, 'delete'])->name('servant.delete');

    });
    Route::get('reception/{reception}/check', [AllocatedBedController::class, 'receptionCheck'])->middleware(['can:check-reception'])->name('reception.check');
    Route::post('/update', [AllocatedBedController::class, 'updateReception'])->name('reception.update');
    Route::get('/people/{nationalCode}', [PeopleController::class, 'findByNationalCode'])->name('people.find');
    Route::get('/servant/{nationalCode}', [ServantController::class, 'findByNationalCode'])->name('servant.find');


    // Places Routes
    Route::name('group.')->prefix('group')->middleware(['role:admin|reception'])->group(function () {
        Route::resource('/', GroupController::class);
        Route::get('/reception/{gender}', [GroupController::class,'reception'])->name('reception');
        Route::post('/reception/{gender}', [GroupController::class,'createReception'])->name('reception');
        Route::get('/{id}/member', [GroupMemberController::class,'index'])->name('member.index');
        Route::post('/{id}/member/store', [GroupMemberController::class,'store'])->name('member.store');

    });




});

Route::get('/register', [PeopleController::class, 'create'])->name('people.register');
Route::post('/create', [PeopleController::class, 'store'])->name('people.create');

Route::get('/province/{id}/cities', [HomeController::class, 'getCities'])->name('home.getCities');
