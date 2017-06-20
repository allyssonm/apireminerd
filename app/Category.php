<?php

namespace Reminerd;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = array('id', 'name', 'color_id');

    public function getCategories()
    {
        $categories = Category::with('color')->get();

        return $response = [
            'categories' => $categories
        ];
    }

    public function getCategory($id)
    {
        $category = Category::with('color')->find($id);

        if ($category) {
            return $response = [
                'category' => $category
            ];
        }

        return $this->message('color not found', 404);
    }

    public function storeCategory($request)
    {
        $category = new Category();
        $category->fill($request->all())->save();

        //TODO: are there another way to do this?
        return $response = [
            'category' => Category::with('color')->find($category->id)
        ];
    }

    public function updateCategory($request, $id)
    {
        $category = Category::with('color')->find($id);

        if (!$category) {
            return $this->message('category not found', 404);
        }

        $category->fill($request->all())->save();

        return $response = [
            'category' => $category
        ];
    }

    public function deleteCategory($id)
    {
        $category = $this->find($id);

        if (!$category) {
            return $this->message('category not found', 404);
        }

        $category->delete();

        return $this->message('category has been excluded', 200);
    }

    private function message($message, $code)
    {
        return response()->json([
            'message' => $message,
        ], $code);
    }

    public function color()
    {
        return $this->belongsTo('Reminerd\Color');
    }

    public function task()
    {
        return $this->hasMany('Reminerd\Task');
    }
}
