<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\RecruitmentController;
use App\Http\Controllers\Back\BackRecruitmentController;
use App\Http\Controllers\Back\RecruitmentUserController;
use App\Http\Controllers\Back\ClassController;
use App\Http\Controllers\Back\DivisionController;
use App\Http\Controllers\Back\SpecializationDivisionController;
use App\Http\Controllers\Back\StudyProgramController;
use App\Http\Controllers\Back\EmailController;
use App\Mail\RecruitmentMail;


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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email', function () {
    return new RecruitmentMail();
});

Route::resource('kirim-email', EmailController::class);

Route::resource('recruitments', RecruitmentController::class);
Route::post('check-email', [RecruitmentController::class, 'checkEmail'])->name('checkEmail');

Route::resource('recruitment-data', BackRecruitmentController::class);
Route::post('check-recruitment-year', [BackRecruitmentController::class, 'checkRecruitmentYear'])->name('checkRecruitmentYear');
Route::resource('recruitment-users', RecruitmentUserController::class);
Route::get('recruitment-user/send-accepted-email/{recruitmentUser}', [RecruitmentUserController::class, 'send_accepted_email'])->name('recruitment-users.send_accepted_email');
Route::get('recruitment-user/send-rejected-email/{recruitmentUser}', [RecruitmentUserController::class, 'send_rejected_email'])->name('recruitment-users.send_rejected_email');
Route::get('recruitment-user/send-all-accepted-email', [RecruitmentUserController::class, 'send_all_accepted_email'])->name('recruitment-users.send_all_accepted_email');
Route::get('recruitment-user/send-all-accepted-emails', [RecruitmentUserController::class, 'send_all_rejected_email'])->name('recruitment-users.send_all_rejected_email');
Route::post('recruitment-data/reset-email/{recruitmentUser}', [RecruitmentUserController::class, 'reset_email'])->name('recruitment-users.reset_email');
Route::post('check-study-program-name', [StudyProgramController::class, 'checkStudyProgramName'])->name('checkStudyProgramName');
Route::resource('classes', ClassController::class);
Route::post('check-class-name', [ClassController::class, 'checkClassName'])->name('checkClassName');
Route::resource('divisions', DivisionController::class);
Route::resource('specialization-divisions', SpecializationDivisionController::class)->except('index', 'show');
Route::post('check-division-name', [DivisionController::class, 'checkDivisionName'])->name('checkDivisionName');
Route::post('check-specialization-division-name', [DivisionController::class, 'checkSpecializationDivisionName'])->name('checkSpecializationDivisionName');
Route::resource('study-programs', StudyProgramController::class);
Route::post('check-study-program-name', [StudyProgramController::class, 'checkStudyProgramName'])->name('checkStudyProgramName');
