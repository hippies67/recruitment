<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\RecruitmentController;
use App\Http\Controllers\Back\BackRecruitmentController;
use App\Http\Controllers\Back\ClassController;
use App\Http\Controllers\Back\DivisionController;
use App\Http\Controllers\Back\SpecializationDivisionController;
use App\Http\Controllers\Back\StudyProgramController;


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

Route::resource('recruitments', RecruitmentController::class);
Route::resource('recruitment-data', BackRecruitmentController::class);
Route::resource('classes', ClassController::class);
Route::post('check-class-name', [ClassController::class, 'checkClassName'])->name('checkClassName');
Route::resource('divisions', DivisionController::class);
Route::resource('specialization-divisions', SpecializationDivisionController::class)->except('index', 'show');
Route::post('check-division-name', [DivisionController::class, 'checkDivisionName'])->name('checkDivisionName');
Route::post('check-specialization-division-name', [DivisionController::class, 'checkSpecializationDivisionName'])->name('checkSpecializationDivisionName');
Route::resource('study-programs', StudyProgramController::class);
Route::post('check-study-program-name', [StudyProgramController::class, 'checkStudyProgramName'])->name('checkStudyProgramName');
