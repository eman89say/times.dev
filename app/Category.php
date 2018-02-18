<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable= ['name'];


    public function articles()
    {
    	return $this->hasMany(Article::class);
    }

    public function scopeCatName($query,$name)
    {
        return $query->where('name','=',$name);
    }
}
