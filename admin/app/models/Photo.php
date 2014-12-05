<?php

class Photo extends Eloquent
{
    protected $table = 'photo';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }

    public function album()
    {
        return $this->belongsTo('Album');
    }
}
