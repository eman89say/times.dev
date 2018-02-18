<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Article;
use App\Category;
use App\Tag;
use Yajra\DataTables\Facades\Datatables;
use Validator;
use Illuminate\Validation\Rule;
use App\Helper\Helper;
use Illuminate\Support\Facades\Auth;



class ArticlesController extends Controller
{
    
    private $helperObj;

    /*  constructor 
    *
    *
    */

    public function __construct(Helper $helper)
    {
       $this->helperObj= $helper;
       $this->middleware('auth');
    }

    /*  function index 
    *   return articles index page
    *
    */
    public function index()
    {
       return response()
             ->view('admin.articles.index');
    }

    /* function getArticles
    *  return datatable of articles
    *
    */

    public function getArticles()
    {
       $articles= Article::select('id','title','created_at');
       return DataTables::of($articles)
       ->addColumn('action',function($article){
        return '<a id="'.$article->id.'" class="view btn btn-primary btn-simple btn-xs" href="/dashboard/articles/'.$article->id.'" rel="tooltip" title="View Article"><i class="material-icons">view_headline</i></a>
          <a id="'.$article->id.'" class="edit btn btn-primary btn-simple btn-xs" href="#" rel="tooltip" title="Edit Article"><i class="material-icons">edit</i></a>
          <a id="'.$article->id.'" class="delete btn btn-danger btn-simple btn-xs" href="#" rel="tooltip" title="Delete Article"><i class="material-icons">close</i></a>';
       })
       ->editColumn('title', function(Article $article) {
                    return str_limit($article->title, 50, '...');
       })
       ->editColumn('created_at', function(Article $article) {
                    return date('M j,Y', strtotime($article->created_at));
       })
       ->addColumn('checkbox','<input type="checkbox" name="customer_checkbox[]" class="article_checkbox" value="{{$id}}" />')
       ->rawColumns(['checkbox','action'])
       ->make(true);
    }

     /* function show
    *  get article from DB
    *
    */

    public function show($id)
    {
          return response()
             ->view('admin.articles.show',['id'=>$id]);
    }


    /* function postArticle
    *  post and update article
    *
    */

    public function postArticle(Request $request)
    {
      $validation = Validator::make($request->all(),[
        'title'=>'required|min:20|max:255',
        'slug'=>['required','alpha_dash','min:5','max:255',Rule::unique('articles','slug')->ignore($request->get('article_id'))],
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

         $tagsData = explode(',', $fields['tagIds']);

         if($request->get('button_action')== "insert")
         {
           $fileNameToStore= $this->helperObj->storeImage($request);
          $fields['cover_image']=$fileNameToStore;
          $article= Auth::User()->articles()->create($fields);

              if(count($tagsData)>0){
               $article->tags()->attach($tagsData);
               }
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
          if(count($tagsData)>0){
                    $article->tags()->sync($tagsData);
                 }
           $success_output="Article updated successfuly";


         }
      }

      $output=array(
        'error'=>$error_array,
        'success'=>$success_output
      );

      echo json_encode($output);
    }


 /* function fetchArticle
    *  get article from DB
    *
    */

    public function fetchArticle(Request $request)
    {
      $id=$request->input('id');
      $article= Article::find($id);

       $articleTags=[];
        foreach($article->tags as $tag) 
        {
           $articleTags[]= $tag->name;
        }
      $output= array(
        'title'=>$article->title,
        'slug'=>$article->slug,
        'body'=>$article->body,
        'cover_image'=>$article->cover_image,
        'category_id'=>$article->category_id,
        'tags'=> $articleTags,
        'user'=> $article->user->name,
        'category'=>$article->category->name,
        'date'=>date('M j,Y', strtotime($article->created_at))

      );
      echo json_encode($output);
    }

     /* function deleteArticle
    *  delete  article from DB
    *
    */


    public function deleteArticle(Request $request)
    {
      $article= Article::find($request->input('id'));
      if($article->delete())
      {
        $article->comments()->delete();
        $this->helperObj->deleteImage($article->cover_image);
        echo "Article Deleted Successfuly";
      }

    }


     /* function delete multiple Articles
    *  delete  articles from DB
    *
    */

    public function deleteMultipleArticles(Request $request)
    {
       $article_id_array= $request->input('id');
        $article= Article::whereIn('id',$article_id_array);
        if($article->delete())
        {
            echo "Data Deleted";
        }
    }



    /*
    *
    *
    */
    function fetchTagsOfthisArticle(Request $request){
      $user= Article::find($request->get('id'));
  $Articletags=[];
  foreach($user->tags as $tag){
  $Articletags[]= $tag->name;
  }

              echo json_encode($Articletags);

    }


     function ckeckSlugUnique(Request $request){
         $validation = Validator::make($request->all(),[
        'slug'=>['alpha_dash',Rule::unique('articles','slug')->ignore($request->get('article_id'))],
      ]);


      $error_array= array();
      if($validation->fails())
      {
         foreach($validation->messages()->getMessages() as $field_name=>$messages)
         {
             $error_array[]= $messages;
         }
      }

       $output=array(
        'error'=>$error_array,
      );

      echo json_encode($output);
    }



}
