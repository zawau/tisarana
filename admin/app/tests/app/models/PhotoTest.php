<?php

/**
 * Testing Photo model.
 */
class PhotoTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        // Set up array in global space to delete all test records.
        // Using global to avoid phpunit reinitalizing variables after each test.
        global $ids, $aids;
        $ids = array();
        $aids = array();
    }

    public static function tearDownAfterClass()
    {
        global $ids, $aids;

        // remove all test records
        if (count($ids) > 0)
            Photo::whereIn('id', $ids)->delete();

        if (count($aids) > 0)
            Album::whereIn('id', $aids)->delete();

        unset($ids);
        unset($aids);
    }

    public function testAdd() 
    {
        global $ids, $aids;

        $photo = new Photo();
        $photo->description = 'Whatever!';
        $photo->file = 'photo.png';
        $photo->album_id = $this->getAlbum();
        $photo->creator = 0;
        $photo->save();

        $this->assertGreaterThan(0, $photo->id);
        $ids[] = $photo->id;

        $temp = Photo::find($photo->id);
        $this->assertEquals($temp->id, $photo->id);
        $this->assertEquals($temp->description, $photo->description);
        $this->assertEquals($temp->file, $photo->file);
        $this->assertEquals($temp->creator, $photo->creator);
    }

    public function testGet() 
    {
        global $ids, $aids;

        $photo = new Photo();
        $photo->description = 'Whatever!';
        $photo->file = 'photo.png';
        $photo->album_id = $this->getAlbum();
        $photo->creator = 0;
        $photo->save();

        $this->assertGreaterThan(0, $photo->id);
        $ids[] = $photo->id;

        $temp = Photo::find($photo->id);
        $this->assertEquals($temp->id, $photo->id);
        $this->assertEquals($temp->description, $photo->description);
        $this->assertEquals($temp->file, $photo->file);
        $this->assertEquals($temp->creator, $photo->creator);
    }

    public function testUpdate() 
    {
        global $ids, $aids;
        
        $photo = new Photo();
        $photo->description = 'Whatever!';
        $photo->file = 'photo.png';
        $photo->album_id = $this->getAlbum();
        $photo->creator = 0;
        $photo->save();

        $this->assertGreaterThan(0, $photo->id);
        $ids[] = $photo->id;

        $photo->description = 'Whatever!';
        $photo->file = 'photo.png';
        $photo->creator = 0;
        $photo->update();

        $temp = Photo::find($photo->id);
        $this->assertEquals($temp->id, $photo->id);
        $this->assertEquals($temp->description, $photo->description);
        $this->assertEquals($temp->file, $photo->file);
        $this->assertEquals($temp->creator, $photo->creator);
    }

    public function testDelete() 
    {
        $photo = new Photo();
        $photo->description = 'Whatever!';
        $photo->file = 'photo.png';
        $photo->album_id = $this->getAlbum();
        $photo->creator = 0;
        $photo->save();

        $this->assertGreaterThan(0, $photo->id);
        
        $id = $photo->id;
        $photo->delete();

        $temp = Photo::find($id);
        $this->assertNull($temp);
    }

    public function getAlbum()
    {
        global $aids; 
 
        $album = new Album();
        $album->title = 'TEST PHOTO';
        $album->description = 'Whatever!';
        $album->creator = 0;
        $album->save();

        $this->assertGreaterThan(0, $album->id);
        $aids[] = $album->id;

        return $album->id;
    }
}
