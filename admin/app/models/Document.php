<?php

class Document extends Eloquent
{
    protected $table = 'document';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }
}
