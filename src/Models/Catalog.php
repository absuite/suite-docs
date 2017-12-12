<?php

namespace Suite\Docs\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_docs_catalogs';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'product_id', 'root_id', 'parent_id', 'post_id', 'title', 'is_revoked'];
	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'product_id', 'root_id', 'parent_id', 'post_id', 'title']);

			static::create($data);
		});
	}
}
