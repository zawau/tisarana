<?php

/**
 * Testing Document model.
 */
class DocumentTest extends TestCase
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
            Document::whereIn('id', $ids)->delete();

        unset($ids);
    }

    public function testAdd() 
    {
        global $ids;

        $document = new Document();
        $document->description = 'Whatever!';
        $document->file = 'document.png';
        $document->creator = 0;
        $document->save();

        $this->assertGreaterThan(0, $document->id);
        $ids[] = $document->id;

        $temp = Document::find($document->id);
        $this->assertEquals($temp->id, $document->id);
        $this->assertEquals($temp->description, $document->description);
        $this->assertEquals($temp->file, $document->file);
        $this->assertEquals($temp->creator, $document->creator);
    }

    public function testGet() 
    {
        global $ids;

        $document = new Document();
        $document->description = 'Whatever!';
        $document->file = 'document.png';
        $document->creator = 0;
        $document->save();

        $this->assertGreaterThan(0, $document->id);
        $ids[] = $document->id;

        $temp = Document::find($document->id);
        $this->assertEquals($temp->id, $document->id);
        $this->assertEquals($temp->description, $document->description);
        $this->assertEquals($temp->file, $document->file);
        $this->assertEquals($temp->creator, $document->creator);
    }

    public function testUpdate() 
    {
        global $ids;
        
        $document = new Document();
        $document->description = 'Whatever!';
        $document->file = 'document.png';
        $document->creator = 0;
        $document->save();

        $this->assertGreaterThan(0, $document->id);
        $ids[] = $document->id;

        $document->description = 'Whatever!';
        $document->file = 'document.png';
        $document->creator = 0;
        $document->update();

        $temp = Document::find($document->id);
        $this->assertEquals($temp->id, $document->id);
        $this->assertEquals($temp->description, $document->description);
        $this->assertEquals($temp->file, $document->file);
        $this->assertEquals($temp->creator, $document->creator);
    }

    public function testDelete() 
    {
        $document = new Document();
        $document->description = 'Whatever!';
        $document->file = 'document.png';
        $document->creator = 0;
        $document->save();

        $this->assertGreaterThan(0, $document->id);
        
        $id = $document->id;
        $document->delete();

        $temp = Document::find($id);
        $this->assertNull($temp);
    }
}
