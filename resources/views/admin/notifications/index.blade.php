@extends('admin.admin-layouts.master')
@section('stylesheets')
   

@endsection

@section('content')


<div class="row">
  <div class="col-md-12">
    <div class="card card-plain">
        <div class="card-header" data-background-color="purple">
            <h4 class="title">Latest Notifications</h4>
        </div>
        <div class="card-content table-responsive">
            <table class="table table-hover" id="categories_table">
                
                <tbody>
                    @forelse($not as $notification)
                    <tr>
                         <td><a href="/dashboard/articles/{{$notification->data['article_id']}}" id="getArticle">Someone commented on your article <strong>{{ str_limit($notification->data['article_title'], 80, '...')}} </strong>
                                <br/><small>@datetime($notification->created_at) </small>                                            
                         </a></td>
                    </tr>
                     @empty
                         <tr>  No Notifications  </tr>
                     @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>



   


</div>

@endsection

