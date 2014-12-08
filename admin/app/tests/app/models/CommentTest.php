<?php

/**
 * Testing Comment model.
 */
class CommentTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        // Set up array in global space to delete all test records.
        // Using global to avoid phpunit reinitalizing variables after each test.
        global $ids, $nids, $aids, $pids, $vids, $dids;
        $ids = array();
        $nids = array();
        $aids = array();
        $pids = array();
        $vids = array();
        $dids = array();
    }

    public static function tearDownAfterClass()
    {
        global $ids, $nids, $aids, $pids, $vids, $dids;

        // remove all test records
        if (count($ids) > 0)
            Comment::whereIn('id', array_unique($ids))->delete();

        if (count($nids) > 0) 
            News::whereIn('id', array_unique($nids))->delete();

        if (count($aids) > 0) 
            Album::whereIn('id', array_unique($aids))->delete();

        if (count($pids) > 0) 
            Photo::whereIn('id', array_unique($pids))->delete();

        if (count($vids) > 0) 
            Video::whereIn('id', array_unique($vids))->delete();

        if (count($dids) > 0) 
            Document::whereIn('id', array_unique($dids))->delete();

        
        unset($ids);
        unset($nids);
        unset($aids);
        unset($pids);
        unset($vids);
        unset($dids);
    }

    public function testAdd() 
    {
    // TEST ADD COMMENT TO NEWS
        $news = $this->getNews();
        $comment = $this->getComment($news->id, 'NEWS');

        // Although Laravel forces us to have id column on intermediate join table, the autoincrement id 
        // column is useless for us. We have to query by target_id and target_type to be useful to us. So, I am
        // testing my query with target_id and target_type throught this test.
        $temp = Comment::where('target_id', '=', $comment->target_id)
                            ->where('target_type', '=', $comment->target_type)->get()[0];

        $this->assertEquals($temp->id, $comment->id);
        $this->assertEquals($temp->target_id, $comment->target_id);
        $this->assertEquals($temp->target_type, $comment->target_type);
        $this->assertEquals($temp->creator, $comment->creator);

    // TEST ADD COMMENT TO ALBUM
        $album = $this->getAlbum();
        $comment = $this->getComment($album->id, 'ALBUM');

        $temp = Comment::where('target_id', '=', $comment->target_id)
                            ->where('target_type', '=', $comment->target_type)->get()[0];

        $this->assertEquals($temp->id, $comment->id);
        $this->assertEquals($temp->target_id, $comment->target_id);
        $this->assertEquals($temp->target_type, $comment->target_type);

    // TEST ADD COMMENT TO PHOTO
        $photo = $this->getPhoto();
        $comment = $this->getComment($photo->id, 'PHOTO');

        $temp = Comment::where('target_id', '=', $comment->target_id)
                            ->where('target_type', '=', $comment->target_type)->get()[0];

        $this->assertEquals($temp->id, $comment->id);
        $this->assertEquals($temp->target_id, $comment->target_id);
        $this->assertEquals($temp->target_type, $comment->target_type);
        
    // TEST ADD COMMENT TO VIDEO
        $video = $this->getVideo();
        $comment = $this->getComment($video->id, 'VIDEO');

        $temp = Comment::where('target_id', '=', $comment->target_id)
                            ->where('target_type', '=', $comment->target_type)->get()[0];

        $this->assertEquals($temp->id, $comment->id);
        $this->assertEquals($temp->target_id, $comment->target_id);
        $this->assertEquals($temp->target_type, $comment->target_type);

    // TEST ADD COMMENT TO DOCUMENT
        $document = $this->getDocument();
        $comment = $this->getComment($document->id, 'DOCUMENT');

        $temp = Comment::where('target_id', '=', $comment->target_id)
                            ->where('target_type', '=', $comment->target_type)->get()[0];

        $this->assertEquals($temp->id, $comment->id);
        $this->assertEquals($temp->target_id, $comment->target_id);
        $this->assertEquals($temp->target_type, $comment->target_type);

    // TEST ADD COMMENT TO COMMENT
        $tempId = $comment->id;
        $comment = $this->getComment($tempId, 'COMMENT');

        $temp = Comment::where('target_id', '=', $comment->target_id)
                            ->where('target_type', '=', $comment->target_type)->get()[0];

        $this->assertEquals($temp->id, $comment->id);
        $this->assertEquals($temp->target_id, $comment->target_id);
        $this->assertEquals($temp->target_type, $comment->target_type);
    }

    public function testGet() 
    {
        $album = $this->getAlbum();
        $comment = $this->getComment($album->id, 'ALBUM');

        $temp = Comment::where('target_id', '=', $comment->target_id)
                            ->where('target_type', '=', $comment->target_type)->get()[0];

        $this->assertEquals($temp->id, $comment->id);
        $this->assertEquals($temp->target_id, $comment->target_id);
        $this->assertEquals($temp->target_type, $comment->target_type);
    }

    // NOTE: We can't test update as only we have primary key by target_id and target_type column  

    public function testDelete() 
    {
        $album = $this->getAlbum();
        $comment = $this->getComment($album->id, 'ALBUM');
        $comment->delete();
        
        $temp = Comment::where('target_id', '=', $album->id)
                            ->where('target_type', '=', 'ALBUM')->get();

        $this->assertLessThanOrEqual(0, count($temp));
    }

    public function getNews()
    {
        global $nids;

        $news = new News();
        $news->title = 'TEST COMMENT';
        $news->details = 'Whatever!';
        $news->publish_date = '2014-11-22 16:11:00';
        $news->creator = 0;
        $news->save();

        $this->assertGreaterThan(0, $news->id);
        $nids[] = $news->id;

        return $news;
    }

    public function getAlbum()
    {
        global $aids; 
 
        $album = new Album();
        $album->title = 'TEST COMMENT';
        $album->description = 'Whatever!';
        $album->creator = 0;
        $album->save();

        $this->assertGreaterThan(0, $album->id);
        $aids[] = $album->id;

        return $album;
    }

    public function getPhoto()
    {
        global $pids;

        $photo = new Photo();
        $photo->description = 'TEST COMMENT!';
        $photo->file = 'photo.png';
        $photo->album_id = $this->getAlbum()->id;
        $photo->creator = 0;
        $photo->save();

        $this->assertGreaterThan(0, $photo->id);
        $pids[] = $photo->id;

        return $photo;
    }

    public function getVideo()
    {
        global $vids;

        $video = new Video();
        $video->description = 'TEST COMMENT!';
        $video->file = 'video.png';
        $video->creator = 0;
        $video->save();

        $this->assertGreaterThan(0, $video->id);
        $vids[] = $video->id;

        return $video;
    }

    public function getDocument()
    {
        global $dids;

        $document = new Document();
        $document->description = 'TEST COMMENT!';
        $document->file = 'document.png';
        $document->creator = 0;
        $document->save();

        $this->assertGreaterThan(0, $document->id);
        $dids[] = $document->id;

        return $document;
    }

    public function getComment($targetId = 0, $targetType = '')
    {
        global $ids;

        $comment = new Comment();
        $comment->target_id = $targetId;
        $comment->target_type = $targetType;
        $comment->ip = '127.0.0.1';
        $comment->comment = 'TEST COMMENT';
        $comment->creator = 0;
        $comment->save();

        $this->assertGreaterThan(0, $comment->id);
        $ids[] = $comment->id;

        return $comment;
    }
}
