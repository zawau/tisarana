<?php

/**
 * Because of Laravel forcing me to change group and user columns to group_id and user_id 
 * (see RenameGroupUserColumnsGroupMemberTest.php), I am renaming action column to action_id 
 * in Acl table just to be consistent.
 */
class RenameActionColumnsAclTest extends TestCase
{
    public function testRename()
    {
        $columnList = Schema::getColumnListing('acl');
        $this->assertFalse(in_array('action', $columnList));
        $this->assertTrue(in_array('action_id', $columnList));
    }
}
