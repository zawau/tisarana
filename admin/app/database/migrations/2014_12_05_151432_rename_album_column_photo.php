<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameAlbumColumnPhoto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('ALTER TABLE `photo` DROP INDEX photo_album_index');
        Schema::table('photo', function($table)
        {
            $table->renameColumn('album', 'album_id');
            $table->index('album_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement('ALTER TABLE `photo` DROP INDEX photo_album_id_index'); 
        Schema::table('photo', function($table)
        {
            $table->renameColumn('album_id', 'album');
            $table->index('album');
        });
	}

}
