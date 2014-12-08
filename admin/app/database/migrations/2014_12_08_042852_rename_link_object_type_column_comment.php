<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * I am sure column name target_id is more meaningful than link_object_id. 
 * It shows that this is the target of the comment we are making against.
 * To align with link_object_id column, I am renaming the link_object_type 
 * column to target_type.
 */
class RenameLinkObjectTypeColumnComment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('comment', function($table)
        {
            $table->renameColumn('link_object_type', 'target_type');
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
            $table->renameColumn('target_type', 'link_object_type');
        });
	}

}
