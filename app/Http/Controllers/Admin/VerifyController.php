<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class VerifyController extends Controller
{
    public function verify($token)
    {
    	User::where('token',$token)->firstOrFail()

    	->update(['token'=> null]);


    	return redirect()->route('dashboard')
    	       ->with('success','Account verified');
    }
}
