<?php

namespace Suite\Docs\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_docs_products';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'code', 'title', 'cover', 'summary', 'is_revoked'];
	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'code', 'title', 'cover', 'summary']);

			$find = array_only($data, ['code', 'ent_id']);
			static::updateOrCreate($find, $data);
		});
	}
}
