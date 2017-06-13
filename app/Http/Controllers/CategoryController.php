<?php

namespace Reminerd\Http\Controllers;

use Reminerd\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = new Category();
        return $categories->getCategories();
    }

    public function show($id)
    {
        $category = new Category();
        return $category->getCategory($id);
    }

    public function store(Request $request)
    {
        $category = new Category();
        return $category->storeCategory($request);
    }

    public function update(Request $request, $id)
    {
        $category = new Category();
        return $category->updateCategory($request, $id);
    }

    public function destroy($id)
    {
        $category = new Category();
        return $category->deleteCategory($id);
    }
}
