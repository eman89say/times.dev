@extends('website.website-layouts.master')


@section('content')

<div class="section">
   <h3>{{$article->title}}</h3>
   <img class="image-container image-left" src="/storage/cover_images/{{$article->cover_image}}" />
   <p>{!! $article->body !!}</p>
</div>

<div class="separator separator-primary"></div>

<div class="section section-team ">
	<div class="team-player">
	    <img src="/img/avatar.jpg" alt="Thumbnail Image" class="rounded-circle img-fluid img-raised">
	    <h4 class="title">Romina Hadid</h4>
	    <p class="category text-primary">Model</p>
	    <p class="description">You can write here details about one of your team members. You can give more details about what they do. Feel free to add some
	        <a href="#">links</a> for people to be able to follow them outside the site.</p>
	    <a href="#pablo" class="btn btn-primary btn-icon btn-round"><i class="fa fa-twitter"></i></a>
	    <a href="#pablo" class="btn btn-primary btn-icon btn-round"><i class="fa fa-instagram"></i></a>
	    <a href="#pablo" class="btn btn-primary btn-icon btn-round"><i class="fa fa-facebook-square"></i></a>
	</div>
</div>

<div class="separator separator-primary"></div>

<div class="section ">
    <h4 class="title text-left"> Comments : </h4>
     <p class="blockquote blockquote-primary">"Over the span of the satellite record, Arctic sea ice has been declining significantly, while sea ice in the Antarctichas increased very slightly"
       <br>
       <br>
       <small>-NOAA</small>
    </p>
</div>

 <div class="separator separator-primary"></div>

   <div class="section  section-contact-us">
            <div class="container">
                <h4 class="title">Leave Comment?</h4>
                <form method="post" id="comment_form" data-toggle="validator"  >
                	{{csrf_field()}}
                	<input type="hidden" id="article_id" name="article_id" value="{{$article->id}}">
	                <div class="row">
	                    <div class="col-lg-8  col-md-8 ml-auto mr-auto">
	                        <div class="input-group input-lg">
	                            <span class="input-group-addon">
	                                <i class="now-ui-icons users_circle-08"></i>
	                            </span>
	                            <input type="text" id="name" class="form-control" placeholder="First Name..." data-error="Please enter your name."  required>
	                            <div class="help-block with-errors"></div>
	                        </div>
	                        
	                        <div class="textarea-container">
	                            <textarea class="form-control" id="body" name="body" rows="4" cols="80" placeholder="Type a comment..." data-error="Please enter your comment."  required></textarea>
	                            <div class="help-block with-errors"></div>
	                        </div>
	                        <div class="send-button">
	                            <input type="submit" name="add_comment" id="add_comment" value="Send Comment" class="btn btn-primary btn-round btn-block btn-lg">
	                        </div>
	                    </div>
	                </div>
                </form>
            </div>
        </div>

@endsection
@section('scripts')
<script src="/js/libraries/validator.js"></script>
<script src="/js/functions/website-functions/ajax-comments.js"></script>


@endsection