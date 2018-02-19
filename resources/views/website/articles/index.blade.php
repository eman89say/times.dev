@extends('website.website-layouts.master')


@section('content')

<div class="section">
   <h3>{{$article->title}}</h3>
   <img class="image-container image-left" src="/storage/cover_images/{{$article->cover_image}}" />
   <p class="text-left">{!! $article->body !!}</p>
</div>

<div class="separator separator-primary"></div>

<div class="section section-team ">
	<div class="team-player">
		<div class="row">
			<div class="col-md-4">
				<img src="/img/avatar.jpg" alt="Thumbnail Image" style="width:70%;" class="rounded-circle img-fluid img-raised">
			</div>
			<div class="col-md-8">
				<h4 class="title"><a href="">Romina Hadid</a></h4>
	    <p class="category text-primary">Model</p>
	    <p class="description">You can write here details about one of your team members. You can give more details about what they do. Feel free to add some
			</div>
		</div>
   
	</div>
</div>

<div class="separator separator-primary"></div>
    <h4 class="title text-left"> <span id="comment-count"></span> Comments  </h4>

   <div class="section  section-comment">
            <div class="container">
                <form method="post" id="comment_form" data-toggle="validator"  >
                	{{csrf_field()}}
                	<input type="hidden" id="article_id" name="article_id" value="{{$article->id}}">
	                <div class="row">
	                    <div class="col-lg-12  col-md-12">
	                        <div class="input-group">
	                            <span class="input-group-addon">
	                                <i class="now-ui-icons users_circle-08"></i>
	                            </span>
	                            <input type="text" id="name" class="form-control" placeholder="First Name..." data-error="Please enter your name."  required>
	                        </div>
	                        <div class="output-error help-block with-errors"></div>
	                        
	                        <div class="textarea-container">
	                            <textarea class="form-control" id="body" name="body" rows="2" cols="80" placeholder="Type a comment..." data-error="Please enter your comment."  required></textarea>
	                          <div class="output-error help-block with-errors"></div>
	                        </div>
	                        <div class="send-button">
	                            <input type="submit" name="add_comment" id="add_comment" value="Send Comment" class="btn btn-primary btn-round  pull-right">
	                            <button type="button" id="cancel" class="btn btn-default pull-right btn-round ">Cancel</button>

	                        </div>
	                    </div>
	                </div>
                </form>
            </div>
        </div>


<div id="load_data"></div>
<div id="load_data_message"></div>

@endsection
@section('scripts')
<script src="/js/libraries/validator.js"></script>
<script src="/js/functions/website-functions/ajax-comments.js"></script>


@endsection