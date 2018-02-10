<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Profile;


class CreateProfile
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
       $profile= new Profile();
       $profile->first_name= $event->user->name;
       $profile->last_name= " ";
       $profile->job_title= " ";
       $profile->address= " ";
       $profile->user_image= 'default-user.png';
       $profile->about= " ";


       $event->user->profile()->save($profile);
    }
}
