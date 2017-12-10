<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteDocsProductsTable extends Migration {
	public $mdID = "81969880dce311e799df97e06b3afaec";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.docs.product')->comment('产品')->tableName('suite_docs_products');

		$md->string('id', 100)->primary();

		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->string('code')->nullable()->comment('编码');
		$md->string('title')->nullable()->comment('名称');

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
