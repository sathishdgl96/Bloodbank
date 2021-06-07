<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class userfeedback extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'product';
    protected $fillable = [
        'phonecompany', 'model','price'
    ];
}
