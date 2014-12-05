<?php

class Video extends Eloquent
{
    protected $table = 'video';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
}
