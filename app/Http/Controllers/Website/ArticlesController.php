<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Article;

class ArticlesController extends Controller
{
    public function index()
    {
    	return view('website.articles.index');
     }

      public function getArticle($name,$slug){
          $category=Category::catName($name)->first();
          $article=Article::bySlug($slug)->first();

          return view('website.articles.index', compact('article','category'));
    }
}
