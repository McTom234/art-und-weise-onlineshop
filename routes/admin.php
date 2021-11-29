<?php

use Illuminate\Support\Facades\Route;

Route::name('admin.')->middleware(['auth'])->group(function () {

});
