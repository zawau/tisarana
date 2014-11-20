<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DbInit extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createNews();
        $this->createAlbum();
        $this->createPhoto();
        $this->createVideo();
        $this->createDocument();
        $this->createComment();
        $this->createEvent();
        $this->createUser();
        $this->createGroup();
        $this->createGroupMember();
        $this->createObject();
        $this->createAction();
        $this->createAcl();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->dropNews();
        $this->dropAlbum();
        $this->dropPhoto();
        $this->dropVideo();
        $this->dropDocument();
        $this->dropComment();
        $this->dropEvent();
        $this->dropUser();
        $this->dropGroup();
        $this->dropGroupMember();
        $this->dropObject();
        $this->dropAction();
        $this->dropAcl();
    }

    /**
     * Create news table.
     *
     * @access private
     * @return void
     */
    private function createNews()
    {
        Schema::create('news', function($table)
        {
            $table->increments('id');
            $table->string('title', 1500);
            $table->text('details');
            $table->dateTime('publish_date')->index();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop news table.
     *
     * @access private
     * @return void
     */
    private function dropNews()
    {
        Schema::drop('news');
    }

    /**
     * Create album table.
     *
     * @access private
     * @return void
     */
    private function createAlbum()
    {
        Schema::create('album', function($table)
        {
            $table->increments('id');
            $table->string('title', 50)->index();
            $table->text('description');
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop album table.
     *
     * @access private
     * @return void
     */
    private function dropAlbum()
    {
        Schema::drop('album');
    }

    /**
     * Create photo table.
     *
     * @access private
     * @return void
     */
    private function createPhoto()
    {
        Schema::create('photo', function($table)
        {
            $table->increments('id');
            $table->text('description');
            $table->string('file', 40)->index();
            $table->integer('album')->unsigned()->index();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop photo table.
     *
     * @access private
     * @return void
     */
    private function dropPhoto()
    {
        Schema::drop('photo');
    }
    
    /**
     * Create video table.
     *
     * @access private
     * @return void
     */
    private function createVideo()
    {
        Schema::create('video', function($table)
        {
            $table->increments('id');
            $table->text('description');
            $table->string('file', 40)->index();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop video table.
     *
     * @access private
     * @return void
     */
    private function dropVideo()
    {
        Schema::drop('video');
    }

    /**
     * Create document table.
     *
     * @access private
     * @return void
     */
    private function createDocument()
    {
        Schema::create('document', function($table)
        {
            $table->increments('id');
            $table->text('description');
            $table->string('file', 40)->index();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * drop document table.
     *
     * @access private
     * @return void
     */
    private function dropDocument()
    {
        Schema::drop('document');
    }

    /**
     * create comment table.
     *
     * @access private
     * @return void
     */
    private function createComment()
    {
        Schema::create('comment', function($table)
        {
            $table->increments('id');
            $table->integer('link')->unsigned()->index();
            $table->enum('link_object', ['NEWS', 'ALBUM', 'PHOTO', 'VIDEO', 'DOCUMENT', 'EVENT'])->index();
            $table->string('ip', 45)->nullable()->index();
            $table->text('comment');
            // default '0' in creator for anonymous comment
            $table->integer('creator')->unsigned()->default(0)->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }
    
    /**
     * drop comment table.
     *
     * @access private
     * @return void
     */
    private function dropComment()
    {
        Schema::drop('comment');
    }

    /**
     * Create event table.
     *
     * @access private
     * @return void
     */
    private function createEvent()
    {
        Schema::create('event', function($table)
        {
            $table->increments('id');
            $table->string('title', 50)->index();
            $table->text('details');
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop event table.
     *
     * @access private
     * @return void
     */
    private function dropEvent()
    {
        Schema::drop('event');
    }

    /**
     * Create user table.
     *
     * @access private
     * @return void
     */
    private function createUser()
    {
        Schema::create('user', function($table)
        {
            $table->increments('id');
            $table->string('first_name', 100)->index();
            $table->string('last_name', 100)->index();
            $table->string('password', 60)->index();
            $table->string('email', 200)->unique();
            $table->dateTime('suspended_date')->index();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop user table.
     *
     * @access private
     * @return void
     */
    private function dropUser()
    {
        Schema::drop('user');
    }

    /**
     * Create group table.
     *
     * @access private
     * @return void
     */
    private function createGroup()
    {
        Schema::create('group', function($table)
        {
            $table->increments('id');
            $table->string('name', 50)->index();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop group table.
     *
     * @access private
     * @return void
     */
    private function dropGroup()
    {
        Schema::drop('group');
    }

    /**
     * Create group_member table.
     *
     * @access private
     * @return void
     */
    private function createGroupMember()
    {
        Schema::create('group_member', function($table)
        {
            $table->integer('group')->unsigned();
            $table->integer('user')->unsigned();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
            $table->primary(['group', 'user']);
        });
    }

    /**
     * Drop group_member table.
     *
     * @access private
     * @return void
     */
    private function dropGroupMember()
    {
        Schema::drop('group_member');
    }

    /**
     * Create object table.
     *
     * @access private
     * @return void
     */
    private function createObject()
    {
        Schema::create('object', function($table)
        {
            $table->increments('id');
            $table->string('name', 50)->index();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop object table.
     *
     * @access private
     * @return void
     */
    private function dropObject()
    {
        Schema::drop('object');
    }

    /**
     * Create action table.
     *
     * @access private
     * @return void
     */
    private function createAction()
    {
        Schema::create('action', function($table)
        {
            $table->increments('id');
            $table->string('name', 50)->index();
            $table->integer('object')->unsigned()->index();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
        });
    }

    /**
     * Drop action table.
     *
     * @access private
     * @return void
     */
    private function dropAction()
    {
        Schema::drop('action');
    }

    /**
     * Create acl table.
     *
     * @access private
     * @return void
     */
    private function createAcl()
    {
        Schema::create('acl', function($table)
        {
            $table->integer('principal')->unsigned();
            $table->enum('principal_type', ['USER', 'GROUP'])->default('USER');
            $table->integer('action')->unsigned();
            $table->integer('creator')->unsigned()->index();
            $table->dateTime('create_date')->index();
            $table->dateTime('update_date')->index();
            $table->primary(['principal', 'principal_type', 'action']);
        });
    }

    /**
     * Drop acl table.
     *
     * @access private
     * @return void
     */
    private function dropAcl()
    {
        Schema::drop('acl');
    }
}
