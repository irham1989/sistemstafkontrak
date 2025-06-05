<?php

use App\Http\Controllers\Staff\Leave\StaffLeaveController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'approval-admin', 'middleware' => ['auth']],function () {
    Route::middleware('activeuser')->group(function () {
        Route::group(['prefix' => 'leave'], function () {
            Route::get('/request/{user_id}', [StaffLeaveController::class, 'leaveRequest'])->name('approval-admin.leave.request');
            Route::post('/request-list', [StaffLeaveController::class, 'requestList']);
        });
    });
});
