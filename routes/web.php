<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contacts', function () {
    $contactsData = [
        'email' => 'info@example.com',
        'phone' => '+7 (999) 123-45-67',
        'address' => 'г. Москва, ул. Лесная, д. 5'
    ];
    return view('contacts', ['data' => $contactsData]);
});