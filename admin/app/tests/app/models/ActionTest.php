<?php

/**
 * Testing Action model.
 */
class ActionTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        // Set up array in global space to delete all test records.
        // Using global to avoid phpunit reinitalizing variables after each test.
        global $aids, $oids;
        $aids = array(); // will store action ids to delete
        $oids = array(); // will store object ids to delete
    }

    public static function tearDownAfterClass()
    {
        global $aids, $oids;
        // remove all test records
        Action::whereIn('id', $aids)->delete();
        Object::whereIn('id', $oids)->delete();
        unset($aids);
        unset($oids);
    }

    public function testAdd() 
    {
        global $aids;

        $action = new Action();
        $action->name = 'Zaw Test Action ADD';
        $action->creator = 0;
        $action->object_id = $this->getObject();
        $action->save();

        $this->assertGreaterThan(0, $action->id);
        $aids[] = $action->id;

        $temp = Action::find($action->id);
        $this->assertEquals($temp->id, $action->id);
        $this->assertEquals($temp->name, $action->name);
        $this->assertEquals($temp->creator, $action->creator);
    }

    public function testGet() 
    {
        global $aids;

        $action = new Action();
        $action->name = 'Zaw Test Action GET';
        $action->creator = 0;
        $action->object_id = $this->getObject();
        $action->save();

        $this->assertGreaterThan(0, $action->id);
        $aids[] = $action->id;

        $temp = Action::find($action->id);
        $this->assertEquals($temp->id, $action->id);
        $this->assertEquals($temp->name, $action->name);
        $this->assertEquals($temp->creator, $action->creator);
    }

    public function testUpdate() 
    {
        global $aids;
        
        $action = new Action();
        $action->name = 'Zaw Test Action UPDATE';
        $action->creator = 0;
        $action->object_id = $this->getObject();
        $action->save();

        $this->assertGreaterThan(0, $action->id);
        $aids[] = $action->id;

        $action->name = 'Test Action';
        $action->update();

        $temp = Action::find($action->id);
        $this->assertEquals($temp->id, $action->id);
        $this->assertEquals($temp->name, $action->name);
    }

    public function testDelete() 
    {
        $action = new Action();
        $action->name = 'Zaw Test Action ADD';
        $action->creator = 0;
        $action->object_id = $this->getObject();
        $action->save();

        $this->assertGreaterThan(0, $action->id);
        
        $id = $action->id;
        $action->delete();

        $temp = Action::find($id);
        $this->assertNull($temp);
    }

    private function getObject()
    {
        global $oids;

        $object = new Object();
        $object->name = 'Zaw Test Object ADD';
        $object->creator = 0;
        $object->save();

        $this->assertGreaterThan(0, $object->id);

        $oids[] = $object->id;

        return $object->id;
    }
}
