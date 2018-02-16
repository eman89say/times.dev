@extends('admin.admin-layouts.master')


@section('content')
 <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Edit Profile</h4>
                <p class="category">Complete your profile</p>
            </div>
            <div class="card-content">
                <form id="profile_form" method="" action="" data-toggle="validator"> 
                  {{csrf_field()}}
                    <div class="row">
                        <input type="hidden" name="user_id" id="user_id" value="{{$profile->user->id}}">
                        <input type="hidden" name="profile_id" id="profile_id" value="{{$profile->id}}">
                    <span id="form_output"></span>

                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Username</label>
                                <input type="text" class="form-control" id="name" value="{{$profile->user->name}}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Email address</label>
                                <input type="email" class="form-control" id="email" value="{{$profile->user->email}}" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Fist Name</label>
                                <input type="text" class="form-control" id="first_name" value="{{$profile->first_name}}" data-error="Please enter first_name."  required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" value="{{$profile->last_name}}" data-error="Please enter last_name."  required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group label-floating">
                                <label class="control-label">Adress</label>
                                <input type="text" class="form-control" id="address" value="{{$profile->address}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group label-floating">
                                <label class="control-label">Job Title</label>
                                <input type="text" class="form-control" id="job_title" value="{{$profile->job_title}}" data-error="Please enter job title."  required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>About Me</label>
                                <div class="form-group label-floating">
                                    <label class="control-label"></label>
                                    <textarea class="form-control" rows="5" id="about">{{$profile->about}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" name="update_profile" id="update_profile" value="Update Profile" class="btn btn-primary pull-right">
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-profile">
            <div class="card-avatar">
                <a href="#pablo">
                    <img class="profileImg" src="/storage/users_images/{{$profile->user_image}}" />
                </a>
            </div>

            <div class="content">
                <h6 class="category text-gray" id="newTitle">{{$profile->job_title}}</h6>
                <h4 class="card-title" id="newName">{{$profile->first_name}} {{$profile->last_name}}</h4>
                <p class="card-content" id="newAbout">
                    {{substr($profile->about,0,70)}}{{strlen($profile->about)>70 ? "...": " "}}
                </p>
                <form enctype="multipart/formdata" method="post" id="uploadProfileImgForm">
                    {{csrf_field()}}
                        <input type="hidden" name="profile_id" id="profile_id" value="{{$profile->id}}">
                     <input type="file" name="userImage" id="userImage" class="filestyle" data-buttonBefore="true" data-size="sm" data-buttonName="btn btn-primary btn-round" data-buttonText="new Profile Image" data-icon="false">
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="/js/libraries/validator.js"></script>
<script src="/js/libraries/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="/js/functions/ajax-profile.js"></script>

@endsection