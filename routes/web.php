<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CertificateController;


Route::get('/', [CertificateController::class, 'index'])->name('certificate.form');
Route::post('/', [CertificateController::class, 'store'])->name('certificate.store');
Route::get('/certificate/{trainer_id}', [CertificateController::class, 'preview'])->name('certificate.show');
Route::get('/verify/{trainer_id}', [CertificateController::class, 'verify'])->name('certificate.verify');
Route::post('/certificate/bulk-upload', [CertificateController::class, 'bulkUpload'])->name('certificate.bulkUpload');


Route::get('/certificates/all', [CertificateController::class, 'showAll'])->name('certificates.all');
Route::post('/certificates/upload', [CertificateController::class, 'upload'])->name('certificates.upload');