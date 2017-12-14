<?php

use Gmf\Sys\Database\Metadata;
use Illuminate\Database\Migrations\Migration;

class CreateSuiteDocsPostsTable extends Migration {
	public $mdID = "5de00f90dce211e7b22519467acb15f0";
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		$md = Metadata::create($this->mdID);
		$md->mdEntity('suite.docs.post')->comment('内容')->tableName('suite_docs_posts');

		$md->string('id', 100)->primary();

		$md->entity('ent', 'gmf.sys.ent')->nullable()->comment('企业');
		$md->entity('user', 'gmf.sys.user')->nullable()->comment('用户');

		$md->entity('product', 'suite.docs.product')->nullable()->comment('产品');
		$md->entity('root', 'suite.docs.post')->nullable()->comment('根');
		$md->entity('parent', 'suite.docs.post')->nullable()->comment('上级节点');

		$md->string('code')->nullable()->comment('编码');
		$md->string('title')->nullable()->comment('名称');
		$md->longText('content')->nullable()->comment('内容');
		$md->string('keywords', 500)->nullable()->comment('关键字');

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
