@extends('admin.admin-layouts.master')


@section('content')

<div class="row">
    <div class="col-md-8"><h3>Tags</h3></div>
    <div class="col-md-4">
        <button type="button" name="add" id="add_tag" class="btn btn-primary pull-right"><i class="material-icons">add</i>Add New Tag</button>
    </div>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">All Tags</h4>
        </div>
        <div class="card-content table-responsive">
            <table class="table" id="tags_table">
                <thead class="text-primary">
                    <th>Name</th>
                    <th>Created At</th>
                    <th>Action</th>
                </thead>
                <tbody>
         
                </tbody>
            </table>
        </div>

    </div>
</div>

<div class="col-md-6" id="add_tag_card" style="display: none">
    <div class="card">
        <div class="card-header" data-background-color="purple">
            <h4 class="title" id="card-title">Add New Tag</h4>
        </div>
        <div class="card-content table-responsive">
            <form  method="post" id="tag_form" data-toggle="validator">
                {{csrf_field()}}
                <span id="form_output"></span>
                <div class="form-group">
                        <label>Enter Name</label>
                        <input type="text" name="name" id="name" class="form-control" data-error="Please enter tag name."  required>
                        <div id="output-error" class="help-block with-errors"></div>
                </div>
                    <input type="hidden" name="tag_id" id="tag_id" value="">
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
<script type="text/javascript" src="/js/libraries/sweetalert.min.js"></script>

<script src="/js/libraries/validator.js"></script>
<script type="text/javascript" src="/js/functions/ajax-tags.js"></script>
@endsection