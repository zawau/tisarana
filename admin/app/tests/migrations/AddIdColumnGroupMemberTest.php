<?php

class AddIdColumnGroupMemberTest extends TestCase
{
    public function testAdd()
    {
        $columnList = Schema::getColumnListing('group_member');
        $this->assertTrue(in_array('id', $columnList));
    }
}
