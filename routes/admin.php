<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')->middleware(['auth'])->group(function () {
    Route::name('dashboard')->get('dashboard', function () {
        return view('dashboard');
    });
});
