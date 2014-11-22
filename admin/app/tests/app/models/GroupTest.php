<?php

/**
 * Testing Group model.
 */
class GroupTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        // Set up array in global space to delete all test records.
        // Using global to avoid phpunit reinitalizing variables after each test.
        global $ids;
        $ids = array();
    }

    public static function tearDownAfterClass()
    {
        global $ids;
        // remove all test records
        Group::whereIn('id', $ids)->delete();
        unset($ids);
    }

    public function testAdd() 
    {
        global $ids;

        $group = new Group();
        $group->name = 'Zaw Test Group ADD';
        $group->creator = 0;
        $group->save();

        $this->assertGreaterThan(0, $group->id);
        $ids[] = $group->id;

        $temp = Group::find($group->id);
        $this->assertEquals($temp->id, $group->id);
        $this->assertEquals($temp->name, $group->name);
        $this->assertEquals($temp->creator, $group->creator);
    }

    public function testGet() 
    {
        global $ids;

        $group = new Group();
        $group->name = 'Zaw Test Group GET';
        $group->creator = 0;
        $group->save();

        $this->assertGreaterThan(0, $group->id);
        $ids[] = $group->id;

        $temp = Group::find($group->id);
        $this->assertEquals($temp->id, $group->id);
        $this->assertEquals($temp->name, $group->name);
        $this->assertEquals($temp->creator, $group->creator);
    }

    public function testUpdate() 
    {
        global $ids;
        
        $group = new Group();
        $group->name = 'Zaw Test Group UPDATE';
        $group->creator = 0;
        $group->save();

        $this->assertGreaterThan(0, $group->id);
        $ids[] = $group->id;

        $group->name = 'Test Group';
        $group->update();

        $temp = Group::find($group->id);
        $this->assertEquals($temp->id, $group->id);
        $this->assertEquals($temp->name, $group->name);
    }

    public function testDelete() 
    {
        $group = new Group();
        $group->name = 'Zaw Test Group ADD';
        $group->creator = 0;
        $group->save();

        $this->assertGreaterThan(0, $group->id);
        
        $id = $group->id;
        $group->delete();

        $temp = Group::find($id);
        $this->assertNull($temp);
    }
}
