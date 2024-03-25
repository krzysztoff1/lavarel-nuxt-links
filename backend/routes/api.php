<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleListController;

Route::get('/articles', [ArticleListController::class, 'index']);
