<?php

class News extends Eloquent
{
    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
}
