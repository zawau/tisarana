<?php

/**
 * Because of Laravel forcing me to change group and user columns to group_id and user_id 
 * (see RenameGroupUserColumnsGroupMemberTesti.php), I am renaming object column to object_id 
 * in Action table just to be consistent.
 */
class RenameObjectColumnActionTest extends TestCase
{
    public function testRename()
    {
        $columnList = Schema::getColumnListing('action');
        $this->assertFalse(in_array('object', $columnList));
        $this->assertTrue(in_array('object_id', $columnList));
    }
}
