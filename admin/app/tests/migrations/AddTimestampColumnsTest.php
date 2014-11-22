<?php

namespace Tisarana\Test\Migrations;

use \Schema;

/**
 * Test add_timestamp_columns database migration script.
 */
class AddTimestampColumnsTest extends \TestCase 
{
    public function testNewsTable()
    {
        $tableList = ['news', 'album', 'photo', 'video', 'document', 'comment', 'event',
                        'user', 'group', 'group_member', 'object', 'action', 'acl'];

        echo "Testing on:\n";
        foreach($tableList as $name) {
            echo "$name\n";
            $this->assertFalse(Schema::hasColumn("$name", 'create_date'));
            $this->assertFalse(Schema::hasColumn("$name", 'update_date'));
            $this->assertTrue(Schema::hasColumn("$name", 'created_at'));
            $this->assertTrue(Schema::hasColumn("$name", 'updated_at'));
        }
    }
}
