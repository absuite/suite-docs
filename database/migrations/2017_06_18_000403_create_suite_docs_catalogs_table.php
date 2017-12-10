<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteDocsCatalogsTable extends Migration {
	public $mdID = "5de015e0dce211e78fdef50528e87a0c";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.docs.catalog')->comment('内容')->tableName('suite_docs_catalogs');

		$md->string('id', 100)->primary();

		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('product', 'suite.docs.product')->nullable()->comment('产品');
		$md->entity('root', 'suite.docs.catalog')->nullable()->comment('根');
		$md->entity('parent', 'suite.docs.catalog')->nullable()->comment('上级节点');
		$md->entity('post', 'suite.docs.post')->nullable()->comment('内容');
		$md->string('title')->comment('名称');

		$md->boolean('is_revoked')->default(0)->comment('撤销');
		$md->timestamps();

		$md->build();

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Metadata::dropIfExists($this->mdID);
	}
}
