<?php

class Acl extends Eloquent
{
    protected $table = 'acl';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
 
    public function action()
    {
        return $this->belongsTo('Action');
    }
}
