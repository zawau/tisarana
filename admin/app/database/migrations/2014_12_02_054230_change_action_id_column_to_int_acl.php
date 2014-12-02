<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Change type of 'action_id' column to integer from enum, which is wrong. 
 *
 * As Laravel does not support alter column type, RAW SQL is used here.
 */
class ChangeActionIdColumnToIntAcl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('ALTER TABLE `acl` MODIFY action_id INT UNSIGNED NOT NULL'); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement("ALTER TABLE `acl` MODIFY action_id ENUM('USER','GROUP') DEFAULT 'USER'"); 
	}

}
