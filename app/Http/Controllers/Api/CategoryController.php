<?php

namespace App\Http\Controllers\Api;

use App\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        return Category::get();
    }
}
