<?php

/**
 * Testing Object model.
 */
class ObjectTest extends TestCase
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
        Object::whereIn('id', $ids)->delete();
        unset($ids);
    }

    public function testAdd() 
    {
        global $ids;

        $object = new Object();
        $object->name = 'Zaw Test Object ADD';
        $object->creator = 0;
        $object->save();

        $this->assertGreaterThan(0, $object->id);
        $ids[] = $object->id;

        $temp = Object::find($object->id);
        $this->assertEquals($temp->id, $object->id);
        $this->assertEquals($temp->name, $object->name);
        $this->assertEquals($temp->creator, $object->creator);
    }

    public function testGet() 
    {
        global $ids;

        $object = new Object();
        $object->name = 'Zaw Test Object GET';
        $object->creator = 0;
        $object->save();

        $this->assertGreaterThan(0, $object->id);
        $ids[] = $object->id;

        $temp = Object::find($object->id);
        $this->assertEquals($temp->id, $object->id);
        $this->assertEquals($temp->name, $object->name);
        $this->assertEquals($temp->creator, $object->creator);
    }

    public function testUpdate() 
    {
        global $ids;
        
        $object = new Object();
        $object->name = 'Zaw Test Object UPDATE';
        $object->creator = 0;
        $object->save();

        $this->assertGreaterThan(0, $object->id);
        $ids[] = $object->id;

        $object->name = 'Test Object';
        $object->update();

        $temp = Object::find($object->id);
        $this->assertEquals($temp->id, $object->id);
        $this->assertEquals($temp->name, $object->name);
    }

    public function testDelete() 
    {
        $object = new Object();
        $object->name = 'Zaw Test Object ADD';
        $object->creator = 0;
        $object->save();

        $this->assertGreaterThan(0, $object->id);
        
        $id = $object->id;
        $object->delete();

        $temp = Object::find($id);
        $this->assertNull($temp);
    }
}
