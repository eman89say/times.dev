<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
USE App\Profile;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Helper\Helper;


class ProfileController extends Controller
{
    
    private $helperObj;

    public function __construct(Helper $helper){
       $this->helperObj= $helper;
       $this->middleware('auth');
    }





    public function index(){
    	$profile= Auth::user()->profile;
    	//dd($profile);
    	return response()
             ->view('admin.user_profile.index',['profile'=>$profile]);
    }


    public function update(Request $request){

    	 $validation = Validator::make($request->all(),[
       
        'user_image'=>'nullable|mimes:jpeg,bmp,png,jpg|max:1999'
      ]);

            $fields=$request->all();
			$profile = Profile::find($request->get('id'));
			$profile->update($fields);
            $success_output="Profile Updated successfuly";


              $output=array( 
              	'fields'=>$fields,
              	'success'=>$success_output
              );

         echo json_encode($output);

    }

    public function uploadProfileImg(Request $request){
    	$profile = Profile::find($request->get('id'));
    	   $fields=$request->all();

    	if($profile->user_image != 'default-user.png'){
    		   $this->helperObj->deleteImage($profile->user_image, 'users_images');
    	}
    	  $fileNameToStore= $this->helperObj->storeImage($request,'user_image', 'users_images');
          $fields['user_image']=$fileNameToStore;
          $profile->update($fields);
          $success_output="New Profile Image Added successfuly";

          $output=array( 
              	'profileImg'=>$fileNameToStore,
              	'success'=>$success_output
              );

         echo json_encode($output);

    }
}
