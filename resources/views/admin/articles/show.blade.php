@extends('admin.admin-layouts.master')

@section('content')
  <div class="row">
         <div class="col-md-10 col-md-offset-1">
            <div class="card">
                <input type="hidden" name="article_id" id="article_id" value="{{$id}}">
                 
                <div class="card-content">
                  <h3>Articles/ <span id="category"></span></h3>
                     <h3 ><strong id="title"></strong></h3>
                <h5>By : <strong id="user"></strong> <br/>
                    created at:    <strong id="date"></strong>
                </h5>

                           


                        <img style="width:100%" src=""><br/><br/>
                <p id="body"></p>

                <h4><strong>Article Tags : </strong></h4>
                <ul id="tags"></ul>


                  <div class="card card-plain">
                  <div class="card-header" data-background-color="purple">
                      <h4 class="title">Article Comments</h4>
                  </div>
                  <div class="card-content table-responsive">
                      <table class="table table-hover" id="comments_table">
                          <thead class="text-primary">
                              <th>Comment</th>
                              <th>Created_at</th>
                              <th>Published</th>
                              <th>Action</th>
                              <th>View</th>
                          </thead>
                          <tbody>
                              
                          </tbody>
                      </table>
                  </div>
                          @include('admin.articles.comments_model')

                </div>
                <hr>

                  <a href="" id="url" class="btn btn-primary pull-right">Go To Article in Website</a>
                  <a href="/dashboard/articles" class="btn btn-default pull-right">Back To Articles</a>


               </div>

           </div>
       </div>
   </div>

@endsection

@section('scripts')
 
  
<script type="text/javascript" src="/js/functions/ajax-viewArticle.js"></script>
  
@endsection   

