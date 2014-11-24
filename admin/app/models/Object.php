<?php

class Object extends Eloquent
{
    // For some reason, Eloquent will not use table named as 'group' and I have to set it here.
    // The reason I can think of is that other database apart from MySQL won't escape keywords used as name.
    protected $table = 'object';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
}
