<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TimeLogController;

// Authentication routes
Auth::routes();

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Home route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Employee resource routes
    Route::resource('employees', EmployeeController::class);

    // Route to process payroll data (POST request)
    Route::get('/payroll/form', [PayrollController::class, 'showPayrollForm'])->name('payroll.form');
    Route::post('/payroll/process', [PayrollController::class, 'processPayroll'])->name('payroll.process');

    // Route to view payroll summary for all employees
    Route::get('/payroll/summary', [PayrollController::class, 'viewPayrollSummary'])->name('payroll.payroll.all_summaries');


    // Route to show the time log form
    Route::get('/timelog/create', [TimeLogController::class, 'create'])->name('timelog.create');

    // Route to store the time log
    Route::post('/timelog', [TimeLogController::class, 'store'])->name('timelog.store');

});

