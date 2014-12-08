<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAndChangeLinkObjectColumnComment extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('ALTER TABLE `comment` DROP INDEX comment_link_object_index');
        DB::statement('ALTER TABLE `comment` CHANGE `link_object` `link_object_type` CHAR(15)');
        DB::statement('ALTER TABLE `comment` ADD UNIQUE INDEX comment_link_object_id_link_object_type_unique (link_object_id, link_object_type)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('ALTER TABLE `comment` DROP INDEX comment_link_object_id_link_object_type_unique');
        DB::statement('ALTER TABLE `comment` CHANGE `link_object_type` `link_object` ENUM("NEWS", "ALBUM", "PHOTO", "VIDEO", "DOCUMENT")');
        DB::statement('ALTER TABLE `comment` ADD INDEX comment_link_object_index (link_object)');
	}
}
