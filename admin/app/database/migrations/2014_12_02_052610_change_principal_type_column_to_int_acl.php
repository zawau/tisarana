<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Change type of 'principal_type' column to integer from enum. 
 * Laravel is having problem with enum type in migrations. 
 *
 * As Laravel does not support alter column type, RAW SQL is used here.
 */
class ChangePrincipalTypeColumnToIntAcl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        DB::statement('ALTER TABLE `acl` MODIFY principal_type INT UNSIGNED NOT NULL'); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::statement("ALTER TABLE `acl` MODIFY principal_type ENUM('USER','GROUP') DEFAULT 'USER'"); 
	}

}
