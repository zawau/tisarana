<?php

/**
 * Testing GroupMember model.
 */
class GroupMemberTest extends TestCase
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
        $groups = array();
        $users = array();

        // remove all test records
        foreach($ids as list($gid,$uid)) {
            GroupMember::where('group_id', '=', $gid)->where('user_id', '=', $uid)->delete();
            $groups[] = $gid;
            $users[] = $uid;
        }

        if (count($groups) > 0) 
            Group::whereIn('id', array_unique($groups))->delete();

        if (count($users) > 0)
            User::whereIn('id', array_unique($users))->delete();

        unset($ids);
    }

    public function testAdd() 
    {
        global $ids;

        $group = $this->getGroup();
        $user = $this->getUser();

        $gm = new GroupMember();
        $gm->group_id = $group->id;
        $gm->user_id = $user->id;
        $gm->creator = 0;
        $gm->save();

        $ids[] = [$group->id, $user->id];

        // Although Laravel forces us to have id column on intermediate join table, the autoincrement id 
        // column is useless for us. We have to query by group_id and user_id to be useful to us. So, I am
        // testing my query with group_id and user_id throught this test.
        $temp = GroupMember::where('group_id', '=', $gm->group_id)
                            ->where('user_id', '=', $gm->user_id)->get()[0];
        $this->assertEquals($temp->group_id, $gm->group_id);
        $this->assertEquals($temp->user_id, $gm->user_id);
        $this->assertEquals($temp->creator, $gm->creator);
    }

    public function testGet() 
    {
        global $ids;

        $group = $this->getGroup();
        $user = $this->getUser();

        $gm = new GroupMember();
        $gm->group_id = $group->id;
        $gm->user_id = $user->id;
        $gm->creator = 0;
        $gm->save();

        $ids[] = [$group->id, $user->id];

        $temp = GroupMember::where('group_id', '=', $gm->group_id)
                            ->where('user_id', '=', $gm->user_id)->get()[0];
        $this->assertEquals($temp->group_id, $gm->group_id);
        $this->assertEquals($temp->user_id, $gm->user_id);
        $this->assertEquals($temp->creator, $gm->creator);
    }

    // NOTE: We can't test update as only we have primary key by group_id and user_id column  

    public function testDelete() 
    {
        global $ids;

        $group = $this->getGroup();
        $user = $this->getUser();

        $gm = new GroupMember();
        $gm->group_id = $group->id;
        $gm->user_id = $user->id;
        $gm->creator = 0;
        $gm->save();

        $ids[] = [$group->id, $user->id];

        $gm->delete();

        $temp = GroupMember::where('group_id', '=', $gm->group_id)->where('user_id', '=', $gm->user_id)->get();
        $this->assertLessThanOrEqual(0, count($temp));
    }

    private function getGroup()
    {
        $group = new Group();
        $group->name = 'Zaw Test Group Member';
        $group->creator = 0;
        $group->save();

        $this->assertGreaterThan(0, $group->id);

        return $group;
    }

    private function getUser()
    {
        $user = new User();
        $user->first_name = 'TEST';
        $user->last_name = 'GROUP MEMBER';
        $user->password = Hash::make('password');
        $user->email = mt_rand() . 'test@gmail.com';
        $user->creator = 0;
        $user->save();

        $this->assertGreaterThan(0, $user->id);

        return $user;      
    }
}
