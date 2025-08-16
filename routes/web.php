<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   /*  return view('welcome'); */
   return redirect('/signin');
});

Route::get('/signin', function() {
    return view('default.signin');
});

Route::get('/signup', function () {
    return view('default.signup');
});

Route::get('/movie', function () {
    return view('main.movie');
});

Route::get('/form/{id?}', function () {
    return view('main.form');
});