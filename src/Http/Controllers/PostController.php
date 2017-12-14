<?php

namespace Suite\Docs\Http\Controllers;

use Gmf\Sys\Http\Controllers\Controller;
use Gmf\Sys\Libs\TreeBuilder;
use Illuminate\Http\Request;
use Suite\Docs\Models;
use Validator;

class PostController extends Controller {
	public function index(Request $request) {
		$size = $request->input('size', 5);
		$query = Models\Post::where('is_revoked', '0');
		$query->where('ent_id', $request->oauth_ent_id);

		$query->orderBy('created_at', 'desc');

		$data = $query->paginate($size);
		return $this->toJson($data);
	}
	public function show(Request $request, string $id) {
		$query = Models\Post::where('is_revoked', '0');
		$data = $query->where('id', $id)->first();
		return $this->toJson($data);
	}
	public function getCatalogs(Request $request) {
		$query = Models\Post::select('id', 'title', 'parent_id');
		if (!empty($request->product)) {
			$query->where('product_id', $request->product);
		}
		return $this->toJson(TreeBuilder::create($query->get()));
	}
	public function store(Request $request) {
		$input = array_only($request->all(), ['id', 'parent_id', 'product_id', 'code', 'title', 'content']);
		$validator = Validator::make($input, [
			'title' => 'required',
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$input['ent_id'] = $request->oauth_ent_id;

		$data = Models\Post::create($input);
		return $this->show($request, $data->id);
	}
	public function update(Request $request, $id) {
		$input = array_only($request->all(), ['code', 'title', 'content']);
		$validator = Validator::make($input, [
			'title' => 'required',
		]);
		if ($validator->fails()) {
			return $this->toError($validator->errors());
		}
		$data = Models\Post::where('id', $id)->update($input);
		return $this->show($request, $id);
	}
	/**
	 * DELETE
	 * @param  Request $request [description]
	 * @param  [type]  $id      [description]
	 * @return [type]           [description]
	 */
	public function destroy(Request $request, $id) {
		$ids = explode(",", $id);
		Models\Post::destroy($ids);
		return $this->toJson(true);
	}
}
