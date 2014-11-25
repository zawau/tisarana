<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * As Laravel does not allow composite(multi-column) primary key and forces you to have id column in 
 * every table, I have no choice but to add autoincrement id columns and make my composite columns unqiue 
 * to avoid duplicate records. 
 */
class AddIdColumnAcl extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('acl', function($table)
        {
            $table->dropPrimary('PRIMARY');
            $table->unique(['principal', 'principal_type', 'action_id']);
        });

        Schema::table('acl', function($table)
        {
            $table->increments('id');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    Schema::table('acl', function($table)
        {
            // On MySQL, you do not need to drop the primary key, which is created with column creation.
            // You only have to drop the column, otherwise, MySQL will give error
            $table->dropColumn('id');
            $table->dropUnique('acl_principal_principal_type_action_id_unique');
        });

        Schema::table('acl', function($table)
        {
            $table->primary(['principal', 'principal_type', 'action_id']);
        });
    }
}
