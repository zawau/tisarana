<?php

class Comment extends Eloquent
{
    protected $table = 'comment';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
}
