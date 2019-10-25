<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dapp extends Model
{
    use SoftDeletes;
    
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function contracts()
    {
    	return $this->hasMany(Contract::class);
    }

    public function uploads()
    {
    	return $this->hasMany(Upload::class);
    }

}
