<?php

namespace App\Helper;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


/**
* 
*/
class Helper
{
	
	public function storeImage(Request $request,$uploadField='cover_image', $uploadFolder='cover_images')
	{
		$fileNameToStore='';

         // handle File upload
		if($request->hasFile($uploadField)){

	        //Get filename with the extension
			$filenameWithExt = $request->file($uploadField)->getClientOriginalName();

			// Get just filename
			$filename=pathinfo($filenameWithExt ,PATHINFO_FILENAME);

			//gET JUST EXTENSION
			$extension= $request->file($uploadField)->getClientOriginalExtension();

			//filename to Store
			$fileNameToStore= $filename.'_'.time().'.'.$extension;

			$path=$request->file($uploadField)->storeAs('public/'.$uploadFolder,$fileNameToStore);
		}else{
			$fileNameToStore='noimage.jpg';
		}

		return $fileNameToStore;
	}



	public function deleteImage( $image='cover_image',$uploadFolder='cover_images')
    {
        if($image!= 'noimage.jpg'){
            //delete Image
            Storage::delete('public/'.$uploadFolder.'/'.$image);
        }


         }
}
