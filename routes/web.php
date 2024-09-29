<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Todo;
use App\Livewire\Render;
use App\Livewire\StudentCrud;
use App\Livewire\ProductCrud;
use App\Livewire\ImageUpload;

Route::get('/counter', Counter::class);
Route::get('/', Render::class);
Route::get('/students', StudentCrud::class);
Route::get('/products', ProductCrud::class);
Route::get('/images', ImageUpload::class);