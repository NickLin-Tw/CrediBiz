<?php

use Illuminate\Support\Facades\Route;

// SPA 路由 - 所有前端路由都由 Vue Router 處理
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
