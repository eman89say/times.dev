<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;
class CategoryController extends Controller
{
    
    public function index()
    {
    	  $categories= Category::all();

    	  return response()->view('admin.categories.index',['categories'=>$categories]);

    }


    public function getCategories()
    {
         $categories= Category::all();

         return response($categories);
    }


    public function store(Request $request)
    {
         $validation = Validator::make($request->all(),[
             'name'=> 'required|min:3|max:255|unique:categories,name'
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
      	  $category= Category::create($fields);
          $success_output="New Category Added successfuly";
         }
          if($request->get('button_action')== "update")
         {
          $category=Category::find($request->get('id'));
 
          $category->update($fields);
           $success_output="Category updated successfuly";

         }

      }

        $output=array(
        'error'=>$error_array,
        'success'=>$success_output,
        'category'=>$category
      );

      echo json_encode($output);
    }


    public function checkUnique(Request $request){
    	 $validation = Validator::make($request->all(),[
             'name'=> 'unique:categories,name'
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
      $category= Category::find($id);
      $output= array(
        'name'=>$category->name,

        'id'=>$category->id

      );
      echo json_encode($output);
    }
}
