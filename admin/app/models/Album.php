<?php

class Album extends Eloquent
{
    protected $table = 'album';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
}
