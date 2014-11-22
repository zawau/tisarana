<?php

/**
 * Testing User model.
 * 
 * As email column must be unique because it is used as a user name, a random number is padded in front of it.
 */
class UserTest extends TestCase
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
        User::whereIn('id', $ids)->delete();
        unset($ids);
    }

    public function testAdd() 
    {
        global $ids;

        $user = new User();
        $user->first_name = 'TEST';
        $user->last_name = 'TEST';
        $user->password = Hash::make('password');
        $user->email = mt_rand() . 'test@gmail.com';
        $user->creator = 0;
        $user->save();

        $this->assertGreaterThan(0, $user->id);
        $ids[] = $user->id;

        $temp = User::find($user->id);
        $this->assertEquals($temp->id, $user->id);
        $this->assertEquals($temp->first_name, $user->first_name);
        $this->assertEquals($temp->last_name, $user->last_name);
        $this->assertEquals($temp->password, $user->password);
        $this->assertEquals($temp->email, $user->email);
        $this->assertEquals($temp->creator, $user->creator);
    }

    public function testGet() 
    {
        global $ids;

        $user = new User();
        $user->first_name = 'TEST';
        $user->last_name = 'TEST';
        $user->password = Hash::make('password');
        $user->email = mt_rand() . 'test@gmail.com';
        $user->creator = 0;
        $user->save();

        $this->assertGreaterThan(0, $user->id);
        $ids[] = $user->id;

        $temp = User::find($user->id);
        $this->assertEquals($temp->id, $user->id);
        $this->assertEquals($temp->first_name, $user->first_name);
        $this->assertEquals($temp->last_name, $user->last_name);
        $this->assertEquals($temp->password, $user->password);
        $this->assertEquals($temp->email, $user->email);
        $this->assertEquals($temp->creator, $user->creator);
    }

    public function testUpdate() 
    {
        global $ids;
        
        $user = new User();
        $user->first_name = 'TEST';
        $user->last_name = 'TEST';
        $user->password = Hash::make('password');
        $user->email = mt_rand() . 'test@gmail.com';
        $user->creator = 0;
        $user->save();

        $this->assertGreaterThan(0, $user->id);
        $ids[] = $user->id;

        $user->first_name = 'NEW TEST';
        $user->last_name = 'TEST NEW';
        $user->password = Hash::make('whatever');
        $user->email = 'test@gmail.com.au';
        $user->creator = 0;
        $user->update();

        $temp = User::find($user->id);
        $this->assertEquals($temp->id, $user->id);
        $this->assertEquals($temp->first_name, $user->first_name);
        $this->assertEquals($temp->last_name, $user->last_name);
        $this->assertEquals($temp->password, $user->password);
        $this->assertEquals($temp->email, $user->email);
        $this->assertEquals($temp->creator, $user->creator);
    }

    public function testDelete() 
    {
        $user = new User();
        $user->first_name = 'TEST';
        $user->last_name = 'TEST';
        $user->password = Hash::make('password');
        $user->email = mt_rand() . 'test@gmail.com';
        $user->creator = 0;
        $user->save();

        $this->assertGreaterThan(0, $user->id);
        
        $id = $user->id;
        $user->delete();

        $temp = User::find($id);
        $this->assertNull($temp);
    }
} 
