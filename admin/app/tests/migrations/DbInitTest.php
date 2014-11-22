<?php

namespace Tisarana\Test\Migrations;

use \Schema;

/**
 * Test the db_init database migration script.
 */
class DbInitTest extends \TestCase 
{

	/**
	 * Test create "news" table is OK.
	 *
	 * @return void
	 */
	public function testCreateNewsTable()
	{
        $this->assertTrue(Schema::hasTable('news'));
        $this->assertTrue(Schema::hasColumn('news', 'id'));
        $this->assertTrue(Schema::hasColumn('news', 'title'));
        $this->assertTrue(Schema::hasColumn('news', 'details'));
        $this->assertTrue(Schema::hasColumn('news', 'publish_date'));
        $this->assertTrue(Schema::hasColumn('news', 'creator'));
        $this->assertTrue(Schema::hasColumn('news', 'create_date'));
        $this->assertTrue(Schema::hasColumn('news', 'update_date'));
	}
    
	/**
	 * Test create "album" table is OK.
	 *
	 * @return void
	 */
	public function testCreateAlbumTable()
	{
        $this->assertTrue(Schema::hasTable('album'));
        $this->assertTrue(Schema::hasColumn('album', 'id'));
        $this->assertTrue(Schema::hasColumn('album', 'title'));
        $this->assertTrue(Schema::hasColumn('album', 'description'));
        $this->assertTrue(Schema::hasColumn('album', 'creator'));
        $this->assertTrue(Schema::hasColumn('album', 'create_date'));
        $this->assertTrue(Schema::hasColumn('album', 'update_date'));
	}
    
	/**
	 * Test create "photo" table is OK.
	 *
	 * @return void
	 */
	public function testCreatePhotoTable()
	{
        $this->assertTrue(Schema::hasTable('photo'));
        $this->assertTrue(Schema::hasColumn('photo', 'id'));
        $this->assertTrue(Schema::hasColumn('photo', 'description'));
        $this->assertTrue(Schema::hasColumn('photo', 'album'));
        $this->assertTrue(Schema::hasColumn('photo', 'file'));
        $this->assertTrue(Schema::hasColumn('photo', 'creator'));
        $this->assertTrue(Schema::hasColumn('photo', 'create_date'));
        $this->assertTrue(Schema::hasColumn('photo', 'update_date'));
	}

	/**
	 * Test create "video" table is OK.
	 *
	 * @return void
	 */
	public function testCreateVideoTable()
	{
        $this->assertTrue(Schema::hasTable('video'));
        $this->assertTrue(Schema::hasColumn('video', 'id'));
        $this->assertTrue(Schema::hasColumn('video', 'description'));
        $this->assertTrue(Schema::hasColumn('video', 'file'));
        $this->assertTrue(Schema::hasColumn('video', 'creator'));
        $this->assertTrue(Schema::hasColumn('video', 'create_date'));
        $this->assertTrue(Schema::hasColumn('video', 'update_date'));
	}

	/**
	 * Test create "document" table is OK.
	 *
	 * @return void
	 */
	public function testCreateDocumentTable()
	{
        $this->assertTrue(Schema::hasTable('document'));
        $this->assertTrue(Schema::hasColumn('document', 'id'));
        $this->assertTrue(Schema::hasColumn('document', 'description'));
        $this->assertTrue(Schema::hasColumn('document', 'file'));
        $this->assertTrue(Schema::hasColumn('document', 'creator'));
        $this->assertTrue(Schema::hasColumn('document', 'create_date'));
        $this->assertTrue(Schema::hasColumn('document', 'update_date'));
    }

	/**
	 * Test create "comment" table is OK.
	 *
	 * @return void
	 */
	public function testCreateCommentTable()
	{
        $this->assertTrue(Schema::hasTable('comment'));
        $this->assertTrue(Schema::hasColumn('comment', 'id'));
        $this->assertTrue(Schema::hasColumn('comment', 'link_object'));
        $this->assertTrue(Schema::hasColumn('comment', 'link'));
        $this->assertTrue(Schema::hasColumn('comment', 'ip'));
        $this->assertTrue(Schema::hasColumn('comment', 'comment'));
        $this->assertTrue(Schema::hasColumn('comment', 'creator'));
        $this->assertTrue(Schema::hasColumn('comment', 'create_date'));
        $this->assertTrue(Schema::hasColumn('comment', 'update_date'));
    }

	/**
	 * Test create "event" table is OK.
	 *
	 * @return void
	 */
	public function testCreateEventTable()
	{
        $this->assertTrue(Schema::hasTable('event'));
        $this->assertTrue(Schema::hasColumn('event', 'id'));
        $this->assertTrue(Schema::hasColumn('event', 'title'));
        $this->assertTrue(Schema::hasColumn('event', 'details'));
        $this->assertTrue(Schema::hasColumn('event', 'creator'));
        $this->assertTrue(Schema::hasColumn('event', 'create_date'));
        $this->assertTrue(Schema::hasColumn('event', 'update_date'));
	}

	/**
	 * Test create "user" table is OK.
	 *
	 * @return void
	 */
	public function testCreateUserTable()
	{
        $this->assertTrue(Schema::hasTable('user'));
        $this->assertTrue(Schema::hasColumn('user', 'id'));
        $this->assertTrue(Schema::hasColumn('user', 'first_name'));
        $this->assertTrue(Schema::hasColumn('user', 'last_name'));
        $this->assertTrue(Schema::hasColumn('user', 'password'));
        $this->assertTrue(Schema::hasColumn('user', 'email'));
        $this->assertTrue(Schema::hasColumn('user', 'suspended_date'));
        $this->assertTrue(Schema::hasColumn('user', 'creator'));
        $this->assertTrue(Schema::hasColumn('user', 'create_date'));
        $this->assertTrue(Schema::hasColumn('user', 'update_date'));
	}

	/**
	 * Test create "group" table is OK.
	 *
	 * @return void
	 */
	public function testCreateGroupTable()
	{
        $this->assertTrue(Schema::hasTable('group'));
        $this->assertTrue(Schema::hasColumn('group', 'id'));
        $this->assertTrue(Schema::hasColumn('group', 'name'));
        $this->assertTrue(Schema::hasColumn('group', 'creator'));
        $this->assertTrue(Schema::hasColumn('group', 'create_date'));
        $this->assertTrue(Schema::hasColumn('group', 'update_date'));
	}

	/**
	 * Test create "group_member" table is OK.
	 *
	 * @return void
	 */
	public function testCreateGroupMemberTable()
	{
        $this->assertTrue(Schema::hasTable('group_member'));
        $this->assertTrue(Schema::hasColumn('group_member', 'group'));
        $this->assertTrue(Schema::hasColumn('group_member', 'user'));
        $this->assertTrue(Schema::hasColumn('group_member', 'creator'));
        $this->assertTrue(Schema::hasColumn('group_member', 'create_date'));
        $this->assertTrue(Schema::hasColumn('group_member', 'update_date'));
	}

	/**
	 * Test create "object" table is OK.
	 *
	 * @return void
	 */
	public function testCreateObjectTable()
	{
        $this->assertTrue(Schema::hasTable('object'));
        $this->assertTrue(Schema::hasColumn('object', 'id'));
        $this->assertTrue(Schema::hasColumn('object', 'name'));
        $this->assertTrue(Schema::hasColumn('object', 'creator'));
        $this->assertTrue(Schema::hasColumn('object', 'create_date'));
        $this->assertTrue(Schema::hasColumn('object', 'update_date'));
	}

	/**
	 * Test create "action" table is OK.
	 *
	 * @return void
	 */
	public function testCreateActionTable()
	{
        $this->assertTrue(Schema::hasTable('action'));
        $this->assertTrue(Schema::hasColumn('action', 'id'));
        $this->assertTrue(Schema::hasColumn('action', 'name'));
        $this->assertTrue(Schema::hasColumn('action', 'object'));
        $this->assertTrue(Schema::hasColumn('action', 'creator'));
        $this->assertTrue(Schema::hasColumn('action', 'create_date'));
        $this->assertTrue(Schema::hasColumn('action', 'update_date'));
	}

	/**
	 * Test create "acl" table is OK.
	 *
	 * @return void
	 */
	public function testCreateAclTable()
	{
        $this->assertTrue(Schema::hasTable('acl'));
        $this->assertTrue(Schema::hasColumn('acl', 'principal'));
        $this->assertTrue(Schema::hasColumn('acl', 'principal_type'));
        $this->assertTrue(Schema::hasColumn('acl', 'action'));
        $this->assertTrue(Schema::hasColumn('acl', 'creator'));
        $this->assertTrue(Schema::hasColumn('acl', 'create_date'));
        $this->assertTrue(Schema::hasColumn('acl', 'update_date'));
	}
}
