<?php

/**
 * Testing Video model.
 */
class VideoTest extends TestCase
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
            Video::whereIn('id', $ids)->delete();

        unset($ids);
    }

    public function testAdd() 
    {
        global $ids;

        $video = new Video();
        $video->description = 'Whatever!';
        $video->file = 'video.png';
        $video->creator = 0;
        $video->save();

        $this->assertGreaterThan(0, $video->id);
        $ids[] = $video->id;

        $temp = Video::find($video->id);
        $this->assertEquals($temp->id, $video->id);
        $this->assertEquals($temp->description, $video->description);
        $this->assertEquals($temp->file, $video->file);
        $this->assertEquals($temp->creator, $video->creator);
    }

    public function testGet() 
    {
        global $ids;

        $video = new Video();
        $video->description = 'Whatever!';
        $video->file = 'video.png';
        $video->creator = 0;
        $video->save();

        $this->assertGreaterThan(0, $video->id);
        $ids[] = $video->id;

        $temp = Video::find($video->id);
        $this->assertEquals($temp->id, $video->id);
        $this->assertEquals($temp->description, $video->description);
        $this->assertEquals($temp->file, $video->file);
        $this->assertEquals($temp->creator, $video->creator);
    }

    public function testUpdate() 
    {
        global $ids;
        
        $video = new Video();
        $video->description = 'Whatever!';
        $video->file = 'video.png';
        $video->creator = 0;
        $video->save();

        $this->assertGreaterThan(0, $video->id);
        $ids[] = $video->id;

        $video->description = 'Whatever!';
        $video->file = 'video.png';
        $video->creator = 0;
        $video->update();

        $temp = Video::find($video->id);
        $this->assertEquals($temp->id, $video->id);
        $this->assertEquals($temp->description, $video->description);
        $this->assertEquals($temp->file, $video->file);
        $this->assertEquals($temp->creator, $video->creator);
    }

    public function testDelete() 
    {
        $video = new Video();
        $video->description = 'Whatever!';
        $video->file = 'video.png';
        $video->creator = 0;
        $video->save();

        $this->assertGreaterThan(0, $video->id);
        
        $id = $video->id;
        $video->delete();

        $temp = Video::find($id);
        $this->assertNull($temp);
    }
}
