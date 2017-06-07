<?php

namespace Reminerd;

use Illuminate\Database\Eloquent\Model;
use DB;

class Color extends Model
{    
    protected $table = 'colors';

	public $timestamps = false;

	protected $fillable = array('name', 'hexadecimal');

    public function getColors() {
        return $response = [
            'colors' => $this->all()
        ];
    }

    public function getColor($id) {
        $color = $this->find($id);

        if($color) {
            return $response = [
                'color' => $color
            ];
        }

        return $this->message('color not found', 404);
        
    }

    public function storeColor($request) {
        $color = new Color();
		$color->fill($request->all());
        $color->save();
        
        return $response = [
            'color' => $color
        ];
    }

    public function updateColor($request, $id) {
        $color = $this->find($id);

        if(!$color) {
            return $this->message('color not found', 404);
        }

        $color->fill($request->all());
        $color->save();

        return $response = [
            'color' => $color
        ];
    }

    public function deleteColor($id) {
        $color = $this->find($id);;

		if(!$color) {
			return $this->message('color not found', 404);
		}

		$color->delete();

		return $this->message('color has been excluded', 200);
    }

    private function message($message, $code) {
        return response()->json([
				'message' => $message,
		], $code);
    }

    public function categories() {
		return $this->hasMany('Reminerd\Category');
    }
}
