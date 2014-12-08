<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * I am sure column name target_id is more meaningful than link_object_id. 
 * It shows that this is the target of the comment we are making against.
 */
class RenameLinkObjectIdColumnComment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('ALTER TABLE `comment` DROP INDEX comment_link_object_id_link_object_type_unique');
        Schema::table('comment', function($table)
        {
            $table->renameColumn('link_object_id', 'target_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('comment', function($table)
        {
            $table->renameColumn('target_id', 'link_object_id');
            $table->unique(['link_object_id', 'link_object_type']);
        });
	}
}
