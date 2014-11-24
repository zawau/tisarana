<?php

class Action extends Eloquent
{
    protected $table = 'action';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }

    public function object() 
    {
        return $this->belongsTo('User');
    }
}
