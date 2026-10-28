<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): View {
    return view('welcome', ['categories' => config('stays'), 'offers' => config('offers'), 'experiences' => config('experiences')]);
})->name('home');

Route::view('/stays', 'stays.index', ['categories' => config('stays')])->name('stays.index');
Route::view('/experiences', 'experiences.index', ['experiences' => config('experiences')])->name('experiences.index');
Route::view('/dining', 'dining')->name('dining');

Route::get('/stays/{category}', function (string $category): View {
    $categories = config('stays');
    abort_unless(isset($categories[$category]), 404);

    return view('stays.show', ['category' => $categories[$category]]);
})->name('stays.show');

Route::get('/offers', function (): View {
    return view('offers.index', ['offers' => config('offers')]);
})->name('offers.index');

Route::get('/offers/{offer}', function (string $offer): View {
    $offers = config('offers');
    abort_unless(isset($offers[$offer]), 404);

    return view('offers.show', ['offer' => $offers[$offer]]);
})->name('offers.show');

Route::get('/experiences/{experience}', function (string $experience): View {
    $experiences = config('experiences');
    abort_unless(isset($experiences[$experience]), 404);

    return view('experiences.show', ['experience' => $experiences[$experience]]);
})->name('experiences.show');
