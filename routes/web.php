<?php


use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



// Route::get('এসএসসি২৪-নির্বাচনী-পরীক্ষা-সংক্রান্ত', function () {
//     echo "test";
//     // return redirect('/admin/login');
// });

Route::get('/', [WebController::class, 'index'])->name('index');
Route::get('notice-board/{cat}', [WebController::class, 'allnotice'])->name('allnotice');
Route::get('contact', [WebController::class, 'contact'])->name('contact');
Route::get('all-download', [WebController::class, 'alldownload'])->name('alldownload');
Route::get('history-details', [WebController::class, 'history_details'])->name('history-details');
Route::get('notice/{slug}', [WebController::class, 'notice'])->name('notice');
Route::get('message/{slug}', [WebController::class, 'message'])->name('message');
Route::get('download/{slug}', [WebController::class, 'download'])->name('download');
Route::get('mujib-corner', [WebController::class, 'mujib_corner'])->name('mujib-corner');
Route::get('mujib-corner-detail/{slug}', [WebController::class, 'mujib_detail'])->name('mujib_detail');
Route::get('/symlink', function () {
    Artisan::call('storage:link');
});
// Move the catch-all route to the end
Route::get('/{slug}', [WebController::class, 'menudesc'])->name('menudesc');






Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('user')->name('user.')->group(function () {

    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {

        Route::view('/login', 'dashboard.user.login')->name('login');
        Route::view('/register', 'dashboard.user.register')->name('register');
        Route::post('create', [UserController::class, 'create'])->name('create');
        Route::post('check', [UserController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:web', 'PreventBackHistory', 'is_first_login'])->group(function () {
        Route::view('/home', 'dashboard.user.home')->name('home');
    });

    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function () {
        Route::view('/change-password', 'dashboard.user.changepass')->name('changepass');
        Route::post('/change-passowrd-action', [UserController::class, 'changePassword'])->name('changepassaction');
        Route::post('logout', [UserController::class, 'logout'])->name('logout');
    });
});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware(['guest:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/login', 'dashboard.admin.login1')->name('login');
        Route::post('check', [AdminController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
        Route::view('/change-password', 'dashboard.admin.changepass')->name('changepass');
        Route::post('/change-passowrd-action', [AdminController::class, 'changePassword'])->name('changepassaction');
        Route::post('logout', [AdminController::class, 'logout'])->name('logout');
    });

    Route::middleware(['auth:admin', 'PreventBackHistory', 'is_admin_first_login'])->group(function () {
        Route::get('home', [AdminController::class, 'index'])->name('home');

        //Menu Management
        Route::get('menu-list', [MenuController::class, 'menulist'])->name('menu-list');
        Route::post('addMenu', [MenuController::class, 'addMenu'])->name('addMenu');
        Route::post('getMenuDetails', [MenuController::class, 'getMenuDetails'])->name('getMenuDetails');
        Route::post('updateMenuDetails', [MenuController::class, 'updateMenuDetails'])->name('updateMenuDetails');
        Route::post('deleteMenu', [MenuController::class, 'deleteMenu'])->name('deleteMenu');

        //Sub Menu Management
        Route::get('submenu-list', [MenuController::class, 'submenulist'])->name('submenu-list');
        Route::post('addSubMenu', [MenuController::class, 'addSubMenu'])->name('addSubMenu');
        Route::post('getSubMenuDetails', [MenuController::class, 'getSubMenuDetails'])->name('getSubMenuDetails');
        Route::post('updateSubMenuDetails', [MenuController::class, 'updateSubMenuDetails'])->name('updateSubMenuDetails');
        Route::post('deleteSubMenu', [MenuController::class, 'deleteSubMenu'])->name('deleteSubMenu');

        //Notice Management
        Route::get('notice-list', [MenuController::class, 'noticelist'])->name('notice-list');
        Route::post('addNotice', [MenuController::class, 'addNotice'])->name('addNotice');
        Route::post('getNoticeDetails', [MenuController::class, 'getNoticeDetails'])->name('getNoticeDetails');
        Route::post('updateNoticeDetails', [MenuController::class, 'updateNoticeDetails'])->name('updateNoticeDetails');
        Route::post('deleteNotice', [MenuController::class, 'deleteNotice'])->name('deleteNotice');

        //Link Management
        Route::get('link-list', [MenuController::class, 'linklist'])->name('link-list');
        Route::post('addLink', [MenuController::class, 'addLink'])->name('addLink');
        Route::post('getLinkDetails', [MenuController::class, 'getLinkDetails'])->name('getLinkDetails');
        Route::post('updateLinkDetails', [MenuController::class, 'updateLinkDetails'])->name('updateLinkDetails');
        Route::post('deleteLink', [MenuController::class, 'deleteLink'])->name('deleteLink');

        //Slider Management
        Route::get('slider-list', [MenuController::class, 'sliderlist'])->name('slider-list');
        Route::post('addSlider', [MenuController::class, 'addSlider'])->name('addSlider');
        Route::post('deleteSlider', [MenuController::class, 'deleteSlider'])->name('deleteSlider');

        // History
        Route::get('institute-history', [MenuController::class, 'history'])->name('history');
        Route::post('updatehistory', [MenuController::class, 'updatehistory'])->name('updatehistory');

        //Mujib Management
        Route::get('mujib-corner-list', [MenuController::class, 'mujiblist'])->name('mujib-corner-list');
        Route::post('addMujibeCorner', [MenuController::class, 'addMujibeCorner'])->name('addMujibeCorner');
        Route::post('getMujibCornerDetails', [MenuController::class, 'getMujibCornerDetails'])->name('getMujibCornerDetails');
        Route::post('updateMujibCornerDetails', [MenuController::class, 'updateMujibCornerDetails'])->name('updateMujibCornerDetails');
        Route::post('deleteMujibCorner', [MenuController::class, 'deleteMujibCorner'])->name('deleteMujibCorner');

        //Upload Management
        Route::get('upload-list', [MenuController::class, 'uploadlist'])->name('upload-list');
        Route::post('addUpload', [MenuController::class, 'addUpload'])->name('addUpload');
        Route::post('getUploadDetails', [MenuController::class, 'getUploadDetails'])->name('getUploadDetails');
        Route::post('updateUploadDetails', [MenuController::class, 'updateUploadDetails'])->name('updateUploadDetails');
        Route::post('deleteUpload', [MenuController::class, 'deleteUpload'])->name('deleteUpload');


        //Message Management
        Route::get('message-list', [MenuController::class, 'messagelist'])->name('message-list');
        Route::post('addMessage', [MenuController::class, 'addMessage'])->name('addMessage');
        Route::post('getMessageDetails', [MenuController::class, 'getMessageDetails'])->name('getMessageDetails');
        Route::post('updateMessageDetails', [MenuController::class, 'updateMessageDetails'])->name('updateMessageDetails');
        Route::post('deleteMessage', [MenuController::class, 'deleteMessage'])->name('deleteMessage');

        // Web Settings
        Route::get('web-settings', [MenuController::class, 'web_settings'])->name('web-settings');
        Route::post('updatewebsettings', [MenuController::class, 'updatewebsettings'])->name('updatewebsettings');
    });
});
