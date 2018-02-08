<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use Yajra\DataTables\Facades\Datatables;
use Validator;

class ArticlesController extends Controller
{
    public function index()
    {
       return response()
             ->view('admin.articles.index');
    }

    public function getArticles()
    {
       $articles= Article::select('id','title','created_at');
       return DataTables::of($articles)
       ->addColumn('action',function($article){
        return '<a id="'.$article->id.'" class="edit" href="#" rel="tooltip" title="Edit Article"><i class="material-icons">edit</i></a>
          <a id="'.$article->id.'" class="delete" href="#" rel="tooltip" title="Delete Article"><i class="material-icons">close</i></a>';
       })
       ->make(true);
    }


    public function postArticle(Request $request)
    {
      $validation = Validator::make($request->all(),[
        'title'=>'required|min:20|max:255',
        'body'=>'required',
      ]);

      $error_array= array();
      $success_output='';
      if($validation->fails())
      {
         foreach($validation->messages()->getMessages() as $field_name=>$messages)
         {
             $error_array[]= $messages;
         }
      }
      else
      {
         if($request->get('button_action')== "insert")
         {
          $article= Article::create($request->all());
          $success_output="New Article Added successfuly";
         }

         if($request->get('button_action')== "update")
         {
          $article=Article::find($request->get('article_id'));
          $article->update($request->all());
           $success_output="Article updated successfuly";


         }
      }

      $output=array(
        'error'=>$error_array,
        'success'=>$success_output
      );

      echo json_encode($output);
    }


    public function fetchArticle(Request $request)
    {
      $id=$request->input('id');
      $article= Article::find($id);
      $output= array(
        'title'=>$article->title,
        'body'=>$article->body
      );
      echo json_encode($output);
    }


    public function deleteArticle(Request $request)
    {
      $article= Article::find($request->input('id'));
      if($article->delete())
      {
        echo "Article Deleted Successfuly";
      }

    }

}
