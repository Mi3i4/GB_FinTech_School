<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Chapter;


class Topic extends Model
{
    //
    protected $table = 'topics';

    public function chapters()
    {
        return $this->belongsTo('App\Chapter');
    }

}
