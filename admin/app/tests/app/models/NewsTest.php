<?php

/**
 * Testing News model.
 */
class NewsTest extends TestCase
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
        News::whereIn('id', $ids)->delete();
        unset($ids);
    }

    public function testAdd() 
    {
        global $ids;

        $news = new News();
        $news->title = 'Zaw Test News ADD';
        $news->details = 'Whatever!';
        $news->publish_date = '2014-11-22 16:11:00';
        $news->creator = 0;
        $news->save();

        $this->assertGreaterThan(0, $news->id);
        $ids[] = $news->id;

        $temp = News::find($news->id);
        $this->assertEquals($temp->id, $news->id);
        $this->assertEquals($temp->title, $news->title);
        $this->assertEquals($temp->details, $news->details);
        $this->assertEquals($temp->publish_date, $news->publish_date);
        $this->assertEquals($temp->creator, $news->creator);
    }

    public function testGet() 
    {
        global $ids;

        $news = new News();
        $news->title = 'Zaw Test News GET';
        $news->details = 'Whatever!';
        $news->publish_date = '2014-11-22 16:11:00';
        $news->creator = 0;
        $news->save();

        $this->assertGreaterThan(0, $news->id);
        $ids[] = $news->id;

        $temp = News::find($news->id);
        $this->assertEquals($temp->id, $news->id);
        $this->assertEquals($temp->title, $news->title);
        $this->assertEquals($temp->details, $news->details);
        $this->assertEquals($temp->publish_date, $news->publish_date);
        $this->assertEquals($temp->creator, $news->creator);
    }

    public function testUpdate() 
    {
        global $ids;
        
        $news = new News();
        $news->title = 'Zaw Test New';
        $news->details = 'Whatever!';
        $news->publish_date = '2014-11-22 16:11:00';
        $news->creator = 0;
        $news->save();

        $this->assertGreaterThan(0, $news->id);
        $ids[] = $news->id;

        $news->title = 'Zaw Test New';
        $news->details = 'Whatever!';
        $news->publish_date = '2014-11-22 16:11:00';
        $news->creator = 0;
        $news->update();

        $temp = News::find($news->id);
        $this->assertEquals($temp->id, $news->id);
        $this->assertEquals($temp->title, $news->title);
        $this->assertEquals($temp->details, $news->details);
        $this->assertEquals($temp->publish_date, $news->publish_date);
        $this->assertEquals($temp->creator, $news->creator);
    }

    public function testDelete() 
    {
        $news = new News();
        $news->title = 'Zaw Test New';
        $news->details = 'Whatever!';
        $news->publish_date = '2014-11-22 16:11:00';
        $news->creator = 0;
        $news->save();

        $this->assertGreaterThan(0, $news->id);
        
        $id = $news->id;
        $news->delete();

        $temp = News::find($id);
        $this->assertNull($temp);
    }
} 
