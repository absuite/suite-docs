<?php

use Gmf\Sys\Builder;
use Illuminate\Database\Seeder;
use Suite\Docs\Models;

class DocsProductSeeder extends Seeder {
	public $entId = '';

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		if (empty($this->entId)) {
			$this->entId = config('gmf.ent.id');
		}
		if (empty($this->entId)) {
			return;
		}

		Models\Product::build(function (Builder $b) {
			$b->ent_id($this->entId)->code('11')
				->title("阿米巴巴套件实施手册")
				->cover('/img/vendor/suite-docs/cover/1.png')
				->summary('这是一本旨在帮助你成功实施阿米巴巴套件的手册');
		});

		Models\Product::build(function (Builder $b) {
			$b->ent_id($this->entId)->code('12')
				->title("阿米巴巴套件帮助文档")
				->cover('/img/vendor/suite-docs/cover/2.png')
				->summary('想获得更多相关信息，请参阅帮助文档!');
		});
		Models\Product::build(function (Builder $b) {
			$b->ent_id($this->entId)->code('13')
				->title("阿米巴巴套件接口开发手册")
				->cover('/img/vendor/suite-docs/cover/3.png')
				->summary('介绍第三方接口如何快速与套件集成，定制接口');
		});

		Models\Product::build(function (Builder $b) {
			$b->ent_id($this->entId)->code('14')
				->title("阿米巴巴套件API说明")
				->cover('/img/vendor/suite-docs/cover/4.png')
				->summary('详细描述套件API信息');
		});
		Models\Product::build(function (Builder $b) {
			$b->ent_id($this->entId)->code('15')
				->title("阿米巴巴套件速查表")
				->cover('/img/vendor/suite-docs/cover/5.png')
				->summary('阿米巴巴套件实体信息查询');
		});
		Models\Product::build(function (Builder $b) {
			$b->ent_id($this->entId)->code('16')
				->title("阿米巴巴套件开发手册")
				->cover('/img/vendor/suite-docs/cover/6.png')
				->summary('阿米巴巴套件实体信息查询');
		});
	}
}
