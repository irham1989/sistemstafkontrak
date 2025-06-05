<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\Branch\AdminBranchController;
use App\Http\Controllers\Admin\Setting\AdminPublicHolidayController;
use App\Http\Controllers\Admin\Setting\AdminStateWeekendHolidayController;
use App\Http\Controllers\Admin\Setting\GradeSettingController;
use App\Http\Controllers\Admin\Setting\PositionSettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth']],function () {
    Route::middleware('activeuser')->group(function () {
        Route::group(['prefix' => 'user'], function () {
            Route::get('/', [AdminUserController::class, 'index'])->name('admin.user.list');
            Route::post('/user-list', [AdminUserController::class, 'userList']);
            Route::post('/store-update', [AdminUserController::class, 'storeUpdateUser']);
            Route::post('/get-info', [AdminUserController::class, 'getInfoUser']);
            Route::post('/user-active', [AdminUserController::class, 'userActive']);
        });

        Route::group(['prefix' => 'branch'], function () {
            Route::get('/', [AdminBranchController::class, 'index'])->name('admin.branch.index');
            Route::post('/branch-list', [AdminBranchController::class, 'branchList']);
            Route::post('/store-update', [AdminBranchController::class, 'storeUpdate']);
            Route::post('/delete', [AdminBranchController::class, 'deleteBranch']);

            Route::get('/{branch_id}/{page}', [AdminBranchController::class, 'branchDetails'])->name('admin.branch.details');
            Route::post('/position-list', [AdminBranchController::class, 'positionList']);
            Route::post('/position-store-update', [AdminBranchController::class, 'positionStoreUpdate']);
            Route::post('/position-get-info', [AdminBranchController::class, 'positionGetInfo']);
            Route::post('/position-delete', [AdminBranchController::class, 'positionDelete']);
        });

        Route::group(['prefix' => 'setting'], function () {
            Route::group(['prefix' => 'public-holiday'], function () {
                Route::get('/', [AdminPublicHolidayController::class, 'index'])->name('admin.setting.publicholiday.index');
                Route::post('/list', [AdminPublicHolidayController::class, 'list']);
            });

            Route::group(['prefix' => 'weekend-holiday'], function () {
                Route::get('/', [AdminStateWeekendHolidayController::class, 'index'])->name('admin.setting.weekendholiday.index');
                Route::post('/list', [AdminStateWeekendHolidayController::class, 'list']);
                Route::post('/store-update', [AdminStateWeekendHolidayController::class, 'storeUpdate']);
                Route::post('/get-info', [AdminStateWeekendHolidayController::class, 'getWeekendHoliday']);
                Route::post('/delete', [AdminStateWeekendHolidayController::class, 'deleteWeekendHoliday']);
            });

            Route::group(['prefix' => 'position'], function () {
                Route::get('/', [PositionSettingController::class, 'index'])->name('admin.setting.position.index');
                Route::post('/list', [PositionSettingController::class, 'list']);
                Route::post('/store-update', [PositionSettingController::class, 'storeUpdate']);
                Route::post('/get-info', [PositionSettingController::class, 'getPosition']);
                Route::post('/delete', [PositionSettingController::class, 'deletePosition']);
            });

            Route::group(['prefix' => 'grade'], function () {
                Route::get('/', [GradeSettingController::class, 'index'])->name('admin.setting.grade.index');
                Route::post('/list', [GradeSettingController::class, 'list']);
                Route::post('/store-update', [GradeSettingController::class, 'storeUpdate']);
                Route::post('/get-info', [GradeSettingController::class, 'getGrade']);
                Route::post('/delete', [GradeSettingController::class, 'deleteGrade']);
            });
        });
    });
});
