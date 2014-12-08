<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * NOTE: Doctrine DBAL is throwing unknown column type enum, so I am using raw SQL.
 */
class RenameLinkColumnComment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
        Schema::table('comment', function($table)
        {
            $table->renameColumn('link', 'link_object_id');
        });
         */
        DB::statement('ALTER TABLE `comment` DROP INDEX comment_link_index');
        DB::statement('ALTER TABLE `comment` CHANGE `link` `link_object_id` INT UNSIGNED NOT NULL');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        /*
        Schema::table('comment', function($table)
        {
            $table->renameColumn('link_object_id', 'link');
        });
        */
        DB::statement('ALTER TABLE `comment` CHANGE `link_object_id` `link` INT UNSIGNED NOT NULL');
        DB::statement('ALTER TABLE `comment` ADD INDEX comment_link_index (link)');
	}
}
