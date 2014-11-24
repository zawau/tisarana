<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameObjectColumnAction extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('action', function($table)
        {
            $table->renameColumn('object', 'object_id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('action', function($table)
        {
            $table->renameColumn('object_id', 'object');
        });
	}

}
