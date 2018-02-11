<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class TagController extends Controller
{
    public function getTags()
    {
    	$tags = Tag::all();
    	return response($tags);
    }
}
