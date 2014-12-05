<?php

/**
 * Testing Acl model.
 */
class AclTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        // Set up array in global space to delete all test records.
        // Using global to avoid phpunit reinitalizing variables after each test.
        global $ids, $oids;
        $ids = array();
        $oids = array();
    }

    public static function tearDownAfterClass()
    {
        global $ids, $oids;
        $groups = array();
        $users = array();
        $action = array();

        // remove all test records
        foreach($ids as list($pid, $ptype, $aid)) {
            Acl::where('principal', '=', $pid)
                ->where('principal_type', '=', $ptype)
                ->where('action_id', '=', $aid)->delete();

            $action [] = $aid;

            if (strtoupper($ptype) == 'G')
                $groups[] = $pid;
            else
                $users[] = $pid;
        }

        if (count($groups) > 0) 
            Group::whereIn('id', array_unique($groups))->delete();

        if (count($users) > 0)
            User::whereIn('id', array_unique($users))->delete();

        if (count($action) > 0)
            Action::whereIn('id', array_unique($action))->delete();

        if (count($oids) > 0)
            Object::whereIn('id', array_unique($oids))->delete();

        unset($ids);
        unset($oids);
    }

    public function testAddWithGroup() 
    {
        global $ids;

        $principal = $this->getGroup();
        $action = $this->getAction();

        $acl = new Acl();
        $acl->principal = $principal->id;
        $acl->principal_type = 'G';
        $acl->action_id = $action->id;
        $acl->creator = 0;
        $acl->save();

        $ids[] = [$acl->principal, $acl->principal_type, $acl->action_id];

        // Although Laravel forces us to have id column on intermediate join table, the autoincrement id 
        // column is useless for us. 
        $temp = Acl::where('principal', '=', $acl->principal)
                        ->where('principal_type', '=', $acl->principal_type)
                        ->where('action_id', '=', $acl->action_id)->get()[0];
        $this->assertEquals($temp->principal, $acl->principal);
        $this->assertEquals($temp->principal_type, $acl->principal_type);
        $this->assertEquals($temp->action_id, $acl->action_id);
        $this->assertEquals($temp->creator, $acl->creator);
    }

    public function testAddWithUser() 
    {
        global $ids;

        $principal = $this->getUser();
        $action = $this->getAction();

        $acl = new Acl();
        $acl->principal = $principal->id;
        $acl->principal_type = 'U';
        $acl->action_id = $action->id;
        $acl->creator = 0;
        $acl->save();

        $ids[] = [$acl->principal, $acl->principal_type, $acl->action_id];

        // Although Laravel forces us to have id column on intermediate join table, the autoincrement id 
        // column is useless for us. 
        $temp = Acl::where('principal', '=', $acl->principal)
                        ->where('principal_type', '=', $acl->principal_type)
                        ->where('action_id', '=', $acl->action_id)->get()[0];
        $this->assertEquals($temp->principal, $acl->principal);
        $this->assertEquals($temp->principal_type, $acl->principal_type);
        $this->assertEquals($temp->action_id, $acl->action_id);
        $this->assertEquals($temp->creator, $acl->creator);
    }


    // NOTE: We can't test update as only we have primary key by group_id and user_id column  

    public function testDeleteWithUser() 
    {
        global $ids;

        $principal = $this->getUser();
        $action = $this->getAction();

        $acl = new Acl();
        $acl->principal = $principal->id;
        $acl->principal_type = 'U';
        $acl->action_id = $action->id;
        $acl->creator = 0;
        $acl->save();

        $ids[] = [$acl->principal, $acl->principal_type, $acl->action_id];

        $acl->delete();

        // Although Laravel forces us to have id column on intermediate join table, the autoincrement id 
        // column is useless for us. 
        $temp = Acl::where('principal', '=', $acl->principal)
                        ->where('principal_type', '=', $acl->principal_type)
                        ->where('action_id', '=', $acl->action_id)->get();

        $this->assertLessThanOrEqual(0, count($temp));
    }

    public function testDeleteWithGroup() 
    {
        global $ids;

        $principal = $this->getGroup();
        $action = $this->getAction();

        $acl = new Acl();
        $acl->principal = $principal->id;
        $acl->principal_type = 'G';
        $acl->action_id = $action->id;
        $acl->creator = 0;
        $acl->save();

        $ids[] = [$acl->principal, $acl->principal_type, $acl->action_id];

        $acl->delete();

        // Although Laravel forces us to have id column on intermediate join table, the autoincrement id 
        // column is useless for us. 
        $temp = Acl::where('principal', '=', $acl->principal)
                        ->where('principal_type', '=', $acl->principal_type)
                        ->where('action_id', '=', $acl->action_id)->get();

        $this->assertLessThanOrEqual(0, count($temp));
    }

    private function getGroup()
    {
        $group = new Group();
        $group->name = 'TEST ACL';
        $group->creator = 0;
        $group->save();

        $this->assertGreaterThan(0, $group->id);

        return $group;
    }

    private function getUser()
    {
        $user = new User();
        $user->first_name = 'TEST';
        $user->last_name = 'ACL';
        $user->password = Hash::make('password');
        $user->email = mt_rand() . 'test@gmail.com';
        $user->creator = 0;
        $user->save();

        $this->assertGreaterThan(0, $user->id);

        return $user;      
    }

    public function getAction() 
    {
        $action = new Action();
        $action->name = 'TEST ACL';
        $action->creator = 0;
        $action->object_id = $this->getObject();
        $action->save();

        $this->assertGreaterThan(0, $action->id);

        return $action;
    }

    private function getObject()
    {
        global $oids;

        $object = new Object();
        $object->name = 'TEST ACL';
        $object->creator = 0;
        $object->save();

        $this->assertGreaterThan(0, $object->id);

        $oids[] = $object->id;

        return $object->id;
    }
}
