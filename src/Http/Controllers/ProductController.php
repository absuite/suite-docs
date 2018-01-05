<?php

namespace Suite\Docs\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Suite\Docs\Models;

class ProductController extends Controller {
	public function index(Request $request) {
		$size = $request->input('size', 15);
		$query = Models\Product::where('is_revoked', '0');
		//$query->where('ent_id', GAuth::entId());
		$query->orderBy('created_at', 'desc');

		$data = $query->paginate($size);
		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\Product::where('is_revoked', '0');
		$data = $query->where('id', $id)->first();
		return $this->toJson($data);
	}
}
