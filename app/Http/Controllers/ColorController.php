<?php

namespace Reminerd\Http\Controllers;

use Reminerd\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index() {
        $colors = new Color();
        return $colors->getColors();
    }

    public function show($id) {
        $color = new Color();
        return $color->getColor($id);        
    }

    public function store(Request $request) {
        $color = new Color();        
        return $color->storeColor($request);
    }

    public function update(Request $request, $id) {
        $color = new Color();
        return $color->updateColor($request, $id);
    }

    public function destroy($id) {
        $color = new Color();
        return $color->deleteColor($id);
    }
}
