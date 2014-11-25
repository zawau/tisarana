<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameActionColumnAcl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
        Schema::table('acl', function($table)
        {
            $table->renameColumn('action', 'action_id');
        });
         */

        // Received DBAL exception with the message saying that underlying database might not 
        // support the ENUM column type. I am going with RAW SQL.
        DB::statement("ALTER TABLE acl CHANGE `action` `action_id` ENUM('USER', 'GROUP')");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        /*
        Schema::table('acl', function($table)
        {
            $table->renameColumn('action_id', 'action');
        });
         */
        
        // Received DBAL exception with the message saying that underlying database might not 
        // support the ENUM column type. I am going with RAW SQL.
        DB::statement("ALTER TABLE acl CHANGE `action_id` `action` ENUM('USER', 'GROUP')");
	}
}
