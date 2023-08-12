<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\User\UserList;
use App\Http\Controllers\Admin\DashboardController;

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
   Route::get('dashboard', DashboardController::class)->name('dashboard');
   Route::prefix('users')->name('users.')->group(function () {
       Route::get('/', UserList::class)->name('list');
   });
});