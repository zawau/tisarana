<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Renaming 'group' and 'user' columns to 'group_id' and 'user_id' respectively. As 'group' and 'user' 
 * are MySQL database keywords and Laravel escapes with backtick(`) in some places and does not in another. 
 * So, I encountered errors in unexpected cases and decided to rename them.
 */
class RenameGroupUserColumnsGroupMember extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        /*
        Schema::table('group_member', function($table) 
        {
            $table->renameColumn('group', 'group_id');
            $table->renameColumn('user', 'user_id');
        });
         */
        // NOTE: 'group' and 'user' are MySQL keywords and as Laravel migration does not escape with
        // back tick (`), it always give me errors and using RAW SQL here.
        DB::statement("ALTER TABLE group_member CHANGE `group` group_id INT UNSIGNED NOT NULL, 
                        CHANGE `user` user_id INT UNSIGNED NOT NULL");
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        /*
        Schema::table('group_member', function($table) 
        {
            $table->renameColumn('group_id', 'group');
            $table->renameColumn('user_id', 'user');
        });
         */
        // NOTE: 'group' and 'user' are MySQL keywords and as Laravel migration does not escape with
        // back tick (`), it always give me errors and using RAW SQL here.
        DB::statement("ALTER TABLE group_member CHANGE group_id `group` INT UNSIGNED NOT NULL, 
                        CHANGE user_id `user` INT UNSIGNED NOT NULL");
	}
}
