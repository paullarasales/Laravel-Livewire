<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;
use App\Livewire\Todo;
use App\Livewire\Render;

Route::get('/counter', Counter::class);
Route::get('/', Render::class);