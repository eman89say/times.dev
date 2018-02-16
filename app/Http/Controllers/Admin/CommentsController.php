<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\Datatables;
use App\Comment;
use App\Article;


class CommentsController extends Controller
{
    public function getComments($id)
    {
    	 $article= Article::find($id);
    	$comments= $article->comments()->select('id','body','approved','created_at');

       return DataTables::of($comments)
       ->addColumn('action',function($comment){
        if($comment->approved==0){
        return '<a id="'.$comment->id.'" class="publish btn btn-primary btn-simple btn-xs" href="#" rel="tooltip" title="publish Comment"><i class="material-icons">publish</i></a>';
      }
      else{
        return '<a id="'.$comment->id.'" class="unPublish btn btn-danger btn-simple btn-xs" href="#" rel="tooltip" title="unPublish Comment"><i class="material-icons">close</i></a>';
      }
          
       })
       ->addColumn('view',function($comment){
        return '<a id="'.$comment->id.'" class="view btn btn-primary btn-simple btn-xs" href="#" rel="tooltip" title="View Comment"><i class="material-icons">view_headline</i></a>';
       })
       ->editColumn('body', function(Comment $comment) {
                    return str_limit($comment->body, 50, '...');
       })
       ->editColumn('created_at', function(Comment $comment) {
                    return date('M j,Y', strtotime($comment->created_at));
      })
      ->editColumn('approved', function(Comment $comment) {
                    if($comment->approved==1){ return '<i class="material-icons">done</i>';} 
                    else{return '<i class="material-icons">close</i>';}           
       })
       ->rawColumns(['approved','action','view'])
       ->make(true);
    }





    public function fetchComment(Request $request)
    {
      $id=$request->input('id');
      $comment= Comment::find($id);

      $output= array(
        'name'=>$comment->name,
        'body'=>$comment->body,
        'date'=>date('M j,Y', strtotime($comment->created_at))

      );
      echo json_encode($output);
    }


    public function publish(Request $request)
    {
       $id=$request->input('id');
      $comment= Comment::find($id);
       $success_output='';
      $button_action= $request->get('button_action');

      if($button_action == 'publish')
      {
        $comment->update(['approved'=>'1']);
         $success_output=' Comment approved and published on the website';

      }
      else if($button_action == 'unPublish')
      {
         $comment->update(['approved'=>'0']);
        $success_output=' Comment not approved and will not published on the website';

      }

       $output= array(
        'success'=> $success_output
       );
       echo json_encode($output);

    }
}
