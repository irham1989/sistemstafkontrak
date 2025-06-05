<?php

use App\Http\Controllers\Staff\Leave\StaffLeaveController;
use App\Http\Controllers\Staff\StaffController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'staff', 'middleware' => ['auth']],function () {
    Route::middleware('activeuser')->group(function () {
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/{user_id}/{page}', [StaffController::class, 'index'])->name('staff.profile');
            Route::post('/store-update-main', [StaffController::class, 'storeUpdateMain']);
            Route::post('/academic-list', [StaffController::class, 'academicList']);
            Route::post('/store-update-academic', [StaffController::class, 'storeUpdateAcademic']);
            Route::post('/get-info-academic', [StaffController::class, 'getAcademicInfo']);
            Route::post('/delete-academic', [StaffController::class, 'deleteAcademic']);
            Route::post('/reset-password', [StaffController::class, 'resetPassword'])->name('staff.reset-password');
            Route::post('/store-update-appointed', [StaffController::class, 'storeUpdateAppointed']);

            Route::get('/get-branch-by-state', [StaffController::class, 'getBranchByState']);
            Route::get('/get-position-by-branch', [StaffController::class, 'getPositionByBranch']);
            Route::post('/store-update-position', [StaffController::class, 'storeUpdatePosition']);
            Route::post('/store-update-new-leave-balance', [StaffController::class, 'storeUpdateNewLeaveBalance']);

            Route::post('/family-list', [StaffController::class, 'familyList']);
            Route::post('/store-update-family', [StaffController::class, 'storeUpdateFamily']);
            Route::post('/get-info-family', [StaffController::class, 'getFamilyInfo']);
            Route::post('/delete-family', [StaffController::class, 'deleteFamily']);
        });

        Route::group(['prefix' => 'leave'], function () {
            Route::get('/request/{user_id}', [StaffLeaveController::class, 'leaveRequest'])->name('staff.leave.request');
            Route::post('/request-list', [StaffLeaveController::class, 'requestList']);
            Route::post('/request-delete', [StaffLeaveController::class, 'requestDelete']);
            Route::get('/new-request/{user_id}', [StaffLeaveController::class, 'leaveNewRequest'])->name('staff.leave.new-request');
            Route::post('/store-update-new-request', [StaffLeaveController::class, 'storeUpdateNewRequest']);
            Route::post('/request-approval', [StaffLeaveController::class, 'requestApproval']);
            Route::get('/get-approver', [StaffLeaveController::class, 'getApprover']);
            Route::get('/approval/{user_id}', [StaffLeaveController::class, 'leaveApproval'])->name('staff.leave.approval');
            Route::post('/approval-list', [StaffLeaveController::class, 'approvalList']);
        });
    });
});
