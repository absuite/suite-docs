<?php

namespace Suite\Docs\Models;
use Closure;
use Gmf\Sys\Builder;
use Gmf\Sys\Traits\HasGuard;
use Gmf\Sys\Traits\Snapshotable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	use Snapshotable, HasGuard;
	protected $table = 'suite_docs_posts';
	public $incrementing = false;
	protected $fillable = ['id', 'ent_id', 'user_id', 'product_id', 'root_id', 'parent_id', 'code', 'title', 'content', 'keywords', 'is_revoked'];
	public static function build(Closure $callback) {
		tap(new Builder, function ($builder) use ($callback) {
			$callback($builder);

			$data = array_only($builder->toArray(), ['id', 'ent_id', 'user_id', 'title', 'content', 'keywords']);

			static::create($data);
		});
	}
}
