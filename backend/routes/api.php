<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleListController;
use App\Http\Controllers\ArticleController;

Route::get('/articles', [ArticleListController::class, 'index']);

Route::get('/article/{slug}', [ArticleController::class, 'index']);
