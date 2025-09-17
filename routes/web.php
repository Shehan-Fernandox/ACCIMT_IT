<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Admin_Panal.index');
});

Route::get('/analytics', function () {
    return view('Admin_Panal.analytics');
});

Route::get('/calender', function () {
    return view('Admin_Panal.calender');
});

Route::get('/employees', function () {
    return view('Admin_Panal.employees');
});

Route::get('/products', function () {
    return view('Admin_Panal.products');
});

Route::get('/oders', function () {
    return view('Admin_Panal.oders');
});

Route::get('/forms', function () {
    return view('Admin_Panal.forms');
});

Route::get('/massages', function () {
    return view('Admin_Panal.massages');
});

Route::get('/navbar', function () {
    return view('navbar');
});

Route::get('/index', function () {
    return view('frontend.index');
});

Route::get('/employee', function () {
    return view('frontend.employee');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/contact', function () {
    return view('frontend.contact');
});

Route::get('/login', function () {
    return view('frontend.login');
});

Route::get('/register', function () {
    return view('frontend.register');
});

// Image Routes
Route::get('/planetBackground', function () {
    return view('interfsce assets.img.bacground.planetBackground');
});

