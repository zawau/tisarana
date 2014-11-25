<?php

class AddIdColumnAclTest extends TestCase
{
    public function testAdd()
    {
        $columnList = Schema::getColumnListing('acl');
        $this->assertTrue(in_array('id', $columnList));
    }
}
