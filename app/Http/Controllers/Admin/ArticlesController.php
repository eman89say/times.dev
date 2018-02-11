<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Category;
use App\Tag;
use Yajra\DataTables\Facades\Datatables;
use Validator;
use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;


class ArticlesController extends Controller
{
    
    private $helperObj;

    public function __construct(Helper $helper)
    {
       $this->helperObj= $helper;
       $this->middleware('auth');
    }


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
        return '<a id="'.$article->id.'" class="edit btn btn-primary btn-simple btn-xs" href="#" rel="tooltip" title="Edit Article"><i class="material-icons">edit</i></a>
          <a id="'.$article->id.'" class="delete btn btn-danger btn-simple btn-xs" href="#" rel="tooltip" title="Delete Article"><i class="material-icons">close</i></a>';
       })
       ->editColumn('title', function(Article $article) {
                    return str_limit($article->title, 50, '...');
       })
       ->editColumn('created_at', function(Article $article) {
                    return date('M j,Y', strtotime($article->created_at));
       })
       ->addColumn('checkbox','<input type="checkbox" name="customer_checkbox[]" class="customer_checkbox" value="{{$id}}" />')
       ->rawColumns(['checkbox','action'])
       ->make(true);
    }


    public function postArticle(Request $request)
    {
      $validation = Validator::make($request->all(),[
        'title'=>'required|min:20|max:255',
        'body'=>'required',
        'cover_image'=>'nullable|mimes:jpeg,bmp,png,jpg|max:1999'
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
          $fields=$request->all();      
         if($request->get('button_action')== "insert")
         {
           $fileNameToStore= $this->helperObj->storeImage($request);
          $fields['cover_image']=$fileNameToStore;
          $article= Auth::User()->articles()->create($fields);

          $article->tags()->attach($fields['tagIds']);

          $success_output="New Article Added successfuly";
         }

         if($request->get('button_action')== "update")
         {
          $article=Article::find($request->get('article_id'));
                // handle File upload
              if($request->hasFile('cover_image')){
                  $fileNameToStore= $this->helperObj->storeImage($request);
                  $this->helperObj->deleteImage($article->cover_image);
                  $fields['cover_image']  = $fileNameToStore;
              }
              
          $article->update($fields);
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
        'body'=>$article->body,
        'cover_image'=>$article->cover_image,
        'category_id'=>$article->category_id

      );
      echo json_encode($output);
    }


    public function deleteArticle(Request $request)
    {
      $article= Article::find($request->input('id'));
      if($article->delete())
      {
        $this->helperObj->deleteImage($article->cover_image);
        echo "Article Deleted Successfuly";
      }

    }


    public function deleteMultipleArticles(Request $request)
    {
       $article_id_array= $request->input('id');
        $article= Article::whereIn('id',$article_id_array);
        if($article->delete())
        {
            echo "Data Deleted";
        }
    }

}
