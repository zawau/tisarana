<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * As Laravel does not allow composite(multi-column) primary key and forces you to have id column in 
 * every table, I have no choice but to add autoincrement id columns and make my composite columns unqiue 
 * to avoid duplicate records. 
 */
class AddIdColumnGroupMember extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('group_member', function($table)
        {
            $table->dropPrimary('PRIMARY');
            $table->unique(['group_id', 'user_id']);
        });

        Schema::table('group_member', function($table)
        {
            $table->increments('id')->after();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('group_member', function($table)
        {
            $table->dropPrimary('PRIMARY');
            $table->dropColumn('id');
            $table->dropUnique('group_member_group_id_user_id_unique');
        });

        Schema::table('group_member', function($table)
        {
            $table->primary(['group_id', 'user_id']);
        });
	}
}
