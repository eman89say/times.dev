<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Validation\Rule;
use Validator;


class TagController extends Controller
{
    

      public function index()
    {

        return response()->view('admin.tags.index');

    }


    public function getTags()
    {


         $tags= Tag::select('id','name','created_at');
       return DataTables::of($tags)
       ->addColumn('action',function($tag){
        return '<a id="'.$tag->id.'" class="edit btn btn-primary btn-simple btn-xs" href="#" rel="tooltip" title="Edit Tag name"><i class="material-icons">edit</i></a>
        <a id="'.$tag->id.'" class="delete btn btn-danger btn-simple btn-xs" href="#" rel="tooltip" title="Delete Tag"><i class="material-icons">close</i></a>
          ';
       })
       ->editColumn('created_at', function(Tag $tag) {
                    return date('M j,Y', strtotime($tag->created_at));
       })
       ->make(true);
    }


  
      public function fetchTags()
    {
    	$tags = Tag::all();
    	return response($tags);
    }


    public function store(Request $request)
    {
         $validation = Validator::make($request->all(),[
         'name'=>['required','min:3','max:255',Rule::unique('tags','name')->ignore($request->get('id'))],

      ]);


      $error_array= array();
      $success_output='';
      $category='';
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
          $tag= Tag::create($fields);
          $success_output="New Tag Added successfuly";
         }
          if($request->get('button_action')== "update")
         {
          $tag=Tag::find($request->get('id'));
 
          $tag->update($fields);
           $success_output="Tag name updated successfuly";

         }

      }

        $output=array(
        'error'=>$error_array,
        'success'=>$success_output,
        'tag'=>$tag
      );

      echo json_encode($output);
    }


    public function checkUnique(Request $request){
       $validation = Validator::make($request->all(),[
         'name'=>Rule::unique('tags','name')->ignore($request->get('id')),
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


    public function show(Request $request)
    {
       $id=$request->input('id');
      $tag= Tag::find($id);
      $output= array(
        'name'=>$tag->name,

        'id'=>$tag->id

      );
      echo json_encode($output);
    }


    public function deleteTag(Request $request)
    {
      $tag= Tag::find($request->input('id'));
      if($tag->delete())
      {
        echo "Tag Deleted Successfuly";
      }

    }

}
