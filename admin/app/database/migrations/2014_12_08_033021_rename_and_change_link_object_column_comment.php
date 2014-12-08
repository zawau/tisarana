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
        DB::statement('ALTER TABLE `comment` CHANGE `link_object` `link_object_type` CHAR(15)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('ALTER TABLE `comment` CHANGE `link_object_type` `link_object` ENUM("NEWS", "ALBUM", "PHOTO", "VIDEO", "DOCUMENT")');
	}

}
