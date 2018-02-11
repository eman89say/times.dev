@extends('admin.admin-layouts.master')
@section('stylesheets')
    <link href="/css/bootstrap-tokenfield.min.css" rel="stylesheet" />
    <link href="/css/tokenfield-typeahead.min.css" rel="stylesheet" />

@endsection

@section('content')

<div class="row">
	<div class="col-md-8"><h3>Articles</h3></div>
	<div class="col-md-4">
		<button type="button" name="add" id="add_article" class="btn btn-primary pull-right">Create New Article</button>
	</div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Latest Articles</h4>
        </div>
        <div class="card-content table-responsive">
            <table class="table" id="articles_table">
                <thead class="text-primary">
                    <th>Title</th>
                    <th>Created_at</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

        @include('admin.articles.articles_model')
    </div>
</div>
</div>

@endsection

@section('scripts')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
<script type="text/javascript" src="/js/libraries/sweetalert.min.js"></script>
<script type="text/javascript" src="/js/libraries/typeahead.bundle.min.js"></script>
<script type="text/javascript" src="/js/libraries/bootstrap-tokenfield.js"></script>
<script src="/js/libraries/validator.js"></script>
<script src="/js/libraries/bootstrap-filestyle.min.js"></script>
<script type="text/javascript" src="/js/functions/ajax-articles.js"></script>
@endsection