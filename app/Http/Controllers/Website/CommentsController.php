<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Article;
use App\Comment;
use Illuminate\Support\Facades\Notification;
use App\Notifications\CommentNewNotification;

class CommentsController extends Controller
{
    public function postComment(Request $request)
    {
    	$validation = Validator::make($request->all(),[
        'name'=>'required',
        'body'=>'required|min:5',
      ]);


      $error_array= array();
      $success_output='';
      $comment= new Comment();
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
          $article= Article::find($request->get('article_id'));
           $article_title= $article->title;

          $user = $article->user; 
 
          $comment= Comment::create($fields);
           Notification::send($user, new CommentNewNotification($comment, $article_title));

          $success_output="New Comment Added successfuly";
         
    }


       $output=array(
        'error'=>$error_array,
        'success'=>$success_output,
        'comment'=>$comment
      );

      echo json_encode($output);
}


   public function getComment(Request $request)
   {
     $comments = Comment::where('article_id', $request->get('article_id'))
                ->orderBy('name', 'desc')
               ->take($request->get('limit'))
               ->offset($request->get('start'))
               ->get();

     return response($comments);   


   }


   public function getCommentCount(Request $request)
   {
     $commentsCount = Comment::where('article_id', $request->get('article_id'))->count();
     return response($commentsCount);
   }



}