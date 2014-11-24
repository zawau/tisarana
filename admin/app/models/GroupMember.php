<?php

class GroupMember extends Eloquent
{
    protected $table = 'group_member';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
 
    public function member()
    {
        return $this->belongsTo('User');
    }

    public function group()
    {
        return $this->belongsTo('Group');
    }
}
