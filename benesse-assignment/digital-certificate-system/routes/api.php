<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CertificateController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/issue-certificate', [CertificateController::class,'issueCertificate']);
Route::post('/register', [StudentController::class,'register']);
Route::post("certificate-issue",[CertificateController::class,'issue']);
Route::post('/verify-certificate', [CertificateController::class,'verifyCertificate']);
Route::post("/test",[CertificateController::class, 'test']);
