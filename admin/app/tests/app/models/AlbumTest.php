<?php

/**
 * Testing Album model.
 */
class AlbumTest extends TestCase
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
        if (count($ids) > 0)
            Album::whereIn('id', $ids)->delete();

        unset($ids);
    }

    public function testAdd() 
    {
        global $ids;

        $album = new Album();
        $album->title = 'Zaw Test Album ADD';
        $album->description = 'Whatever!';
        $album->creator = 0;
        $album->save();

        $this->assertGreaterThan(0, $album->id);
        $ids[] = $album->id;

        $temp = Album::find($album->id);
        $this->assertEquals($temp->id, $album->id);
        $this->assertEquals($temp->title, $album->title);
        $this->assertEquals($temp->description, $album->description);
        $this->assertEquals($temp->creator, $album->creator);
    }

    public function testGet() 
    {
        global $ids;

        $album = new Album();
        $album->title = 'Zaw Test Album GET';
        $album->description = 'Whatever!';
        $album->creator = 0;
        $album->save();

        $this->assertGreaterThan(0, $album->id);
        $ids[] = $album->id;

        $temp = Album::find($album->id);
        $this->assertEquals($temp->id, $album->id);
        $this->assertEquals($temp->title, $album->title);
        $this->assertEquals($temp->description, $album->description);
        $this->assertEquals($temp->creator, $album->creator);
    }

    public function testUpdate() 
    {
        global $ids;
        
        $album = new Album();
        $album->title = 'Zaw Test New';
        $album->description = 'Whatever!';
        $album->creator = 0;
        $album->save();

        $this->assertGreaterThan(0, $album->id);
        $ids[] = $album->id;

        $album->title = 'Zaw Test New';
        $album->description = 'Whatever!';
        $album->creator = 0;
        $album->update();

        $temp = Album::find($album->id);
        $this->assertEquals($temp->id, $album->id);
        $this->assertEquals($temp->title, $album->title);
        $this->assertEquals($temp->description, $album->description);
        $this->assertEquals($temp->creator, $album->creator);
    }

    public function testDelete() 
    {
        $album = new Album();
        $album->title = 'Zaw Test New';
        $album->description = 'Whatever!';
        $album->creator = 0;
        $album->save();

        $this->assertGreaterThan(0, $album->id);
        
        $id = $album->id;
        $album->delete();

        $temp = Album::find($id);
        $this->assertNull($temp);
    }
}
