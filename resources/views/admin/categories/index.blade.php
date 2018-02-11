@extends('admin.admin-layouts.master')
@section('stylesheets')
   

@endsection

@section('content')

<div class="row">
	<div class="col-md-8"><h3>Categories</h3></div>
	<div class="col-md-4">
		<button type="button" name="add" id="add_category" class="btn btn-primary pull-right"><i class="material-icons">add</i>Add New Category</button>
	</div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">All Categories</h4>
        </div>
        <div class="card-content table-responsive">
            <table class="table" id="categories_table">
                <thead class="text-primary">
                    <th>Name</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                       <tr id="{{$category->id}}">
                        <td>{{$category->name}}</td>
                        <td><a id="{{$category->id}}" class="edit btn btn-primary btn-simple btn-xs" href="#" rel="tooltip" title="Edit Category Name"><i class="material-icons" >edit</i></a></td>
                      </tr>
                      
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="col-md-6" id="add_category_card" style="display: none">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title" id="card-title">Add New Category</h4>
        </div>
        <div class="card-content table-responsive">
            <form  method="post" id="category_form" data-toggle="validator">
                {{csrf_field()}}
                <span id="form_output"></span>
                <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control" data-error="Please enter category name."  required>
                        <div id="output-error" class="help-block with-errors"></div>
                </div>
                    <input type="hidden" name="category_id" id="category_id" value="">
                    <input type="hidden" name="button_action" id="button_action" value="insert">
                    <input type="submit" name="submit" id="action" value="Add" class="btn btn-success">
                    <button type="button" id="cancel" class="btn btn-default">Cancel</button>


            </form>
        </div>

    </div>
</div>


   


</div>

@endsection

@section('scripts')
<script type="text/javascript" src="/js/libraries/jquery.tabledit.min.js"></script>
<script src="/js/libraries/validator.js"></script>
<script type="text/javascript" src="/js/functions/ajax-categories.js"></script>
@endsection