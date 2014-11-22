<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * After reading Eloquent ORM, I have found out that it has automatice timestamp feature and my previous 
 * design of putting create_date and update_date columns in each table is now irrelevant. I am dropping 
 * both columns and indexes on them in this migration script.
 */
class AddTimestampColumns extends Migration {

    protected $tableList = ['news', 'album', 'photo', 'video', 'document', 'comment', 'event',
                            'user', 'group', 'group_member', 'object', 'action', 'acl'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->tableList as $name) {
            $this->apply($name);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach($this->tableList as $name) {
            $this->revert($name);
        }
    }

    /**
     * On the table:
     *
     * Drop create/update date indexes and column.
     * Add created_at and updated_at timestamps and indexes. 
     *
     * @access private
     * @return void
     */
    private function apply($name)
    {
        Schema::table("$name", function($table) use ($name)
        {
            $table->dropIndex($name . '_create_date_index');
            $table->dropIndex($name . '_update_date_index');
            $table->dropColumn('create_date');
            $table->dropColumn('update_date');
            $table->timestamps();
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * On the table:
     *
     * Drop created_at and updated_at indexex and columns.
     * Add create/update date and indexes.
     *
     * @access private
     * @return void
     */
    private function revert($name)
    {
        Schema::table("$name", function($table) use ($name)
        {
            $table->dropIndex($name . '_created_at_index');
            $table->dropIndex($name . '_updated_at_index');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }
}
