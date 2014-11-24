<?php

class Group extends Eloquent
{
    // For some reason, Eloquent will not use table named as 'group' and I have to set it here.
    // The reason I can think of is that other database apart from MySQL won't escape keywords used as name.
    protected $table = 'group';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
 
    public function members()
    {
        return $this->belongsToMany('User', 'group_member', 'user_id', 'group_id');
    }
}
