<?php


use App\Http\Controllers\UserController;

Route::get('/', [UserController::class,'index'])->name('users.index');
Route::post('/import', [UserController::class, 'import'])->name('users.import');
Route::get('/export', [UserController::class, 'export'])->name('users.export');
Route::get('/download-text', [UserController::class, 'downloadText'])->name('users.downloadText');

