<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Make suspended date null in user table.
 * 
 * As Laravel's migration does not have modify column command, raw SQL is used.
 */
class NullableUserSuspendedDateColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
    {
        Schema::table('user', function($table) 
        {
	        DB::statement('ALTER TABLE user MODIFY suspended_date DATETIME NULL');
        });    
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('user', function($table) 
        {
	        DB::statement('ALTER TABLE user MODIFY suspended_date DATETIME NOT NULL');
        });    
	}
}
