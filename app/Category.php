<?php

namespace Reminerd;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

	public $timestamps = false;

	protected $fillable = array('name', 'color_id');

    public function getCategories() {
        $categories = $this->all();
        $data = [];

        foreach ($categories as $c) {
            $category = [
                'name' => $c->name,
                'color' => $c->color
            ];
            array_push($data, $category);
        }

        return $response = [
            'categories' => $data
        ];
    }

    public function getCategory($id) {
        $category = $this->find($id);

        if($category) {
            return $response = [
                'category' => $category->name,
                'color' => $category->color
            ];
        }

        return $this->message('color not found', 404);        
    }

    public function storeCategory($request) {
        $category = new Category();
		$category->fill($request->all());
        $category->save();
        
        return $response = [
            'category' => $category->name,
            'color' => $category->color
        ];
    }

    public function updateCategory($request, $id) {
        $category = $this->find($id);

        if(!$category) {
            return $this->message('category not found', 404);
        }

        $category->fill($request->all());
        $category->save();

        return $response = [
            'category' => $category->name,
            'color' => $category->color
        ];
    }

    public function deleteCategory($id) {
        $category = $this->find($id);

		if(!$category) {
			return $this->message('category not found', 404);
		}

		$category->delete();

		return $this->message('category has been excluded', 200);
    }

    private function message($message, $code) {
        return response()->json([
				'message' => $message,
		], $code);
    }

    public function color() {
		return $this->belongsTo('Reminerd\Color');
	}

    public function task() {
        return $this->hasMany('Reminerd\Task');
    }
}
