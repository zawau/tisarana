<?php

class RenameGroupUserColumnsGroupMemberTest extends TestCase
{
    public function testRename()
    {
        /*
            var_dump(Schema::getColumnListing('group_member'));
            $this->assertFalse(Schema::hasColumn('group_memeber', 'group'));
            $this->assertFalse(Schema::hasColumn('group_memeber', 'user'));
            $this->assertTrue(Schema::hasColumn('group_memeber', 'group_id'));
            $this->assertTrue(Schema::hasColumn('group_memeber', 'user_id'));
         */

        // For some unknown reason, hasColumn function always return FALSE on 
        // group_id and user_id after migration and test return FAIL. So, I do it 
        // like below; get column list in array and search the column inside the array. 
        $columnList = Schema::getColumnListing('group_member');
        $this->assertFalse(in_array('group', $columnList));
        $this->assertFalse(in_array('user', $columnList));
        $this->assertTrue(in_array('group_id', $columnList));
        $this->assertTrue(in_array('user_id', $columnList));
    }
}
