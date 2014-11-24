<?php

class Object extends Eloquent
{
    protected $table = 'object';

    public function creator()
    {
        return $this->belongsTo('User', 'id', 'creator');
    }

    public function actions()
    {
        return $this->hasMany('Action');
    }
}
