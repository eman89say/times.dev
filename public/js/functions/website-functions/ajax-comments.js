var formId = '#comment_form';
var url= '/article/comments';
var article_id = $('#article_id').val();

$(document).ready(function(){

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});


var limit = 3;
var start = 0;
var action= 'inactive';

getCommentCount();



function load_comments_data(limit,start)
{
     $.ajax({
         url:url+ '/getComments',
         method:"get",
         data:{article_id:article_id, limit:limit, start:start},
         dataType:"json",
         cache:false,
        
         success:function(data)
         {          
         if(data=='')
          {
            $('#load_data_message').html("<button type='button' class='btn btn-info'>No More Comments</button>");
            action="active";
          }
          else
          {
               $('#load_data').append(appendComment(data));

            $('#load_data_message').html("<button type='button' class='btn btn-warning'>Please Wait ....</button>");
            action="inactive";

          }   
         }

       });   
}
 
 if(action="inactive")
 {
  action="active";
  load_comments_data(limit,start);
 }

 $(window).scroll(function(){
  if($(window).scrollTop()+ $(window).height() > $('#load_data').height() && action=='inactive')
  {
      action="active";
      start= start+ limit;
      setTimeout(function(){
          load_comments_data(limit,start);
        },1000);

  }
 });

  
////////////////////////////////////////////////////////////////////////

   $('#add_comment').on('click',function(event){
       event.preventDefault();

         var form_data={
                    ' _token':$(formId).find("input[name='_token']").val(),
                     'article_id':$('#article_id').val(),
                    'name':$('#name').val(),
                    'body':$('#body').val(),
                     };

       $.ajax({
         url:url,
         method:"POST",
         data:form_data,
         dataType:"json",
         
         success:function(data)
         {          
         if(data.error.length>0)
          {
              console.log(data.error);
          }
          else
          {
              console.log( data.success);
              $(formId)[0].reset();
              $('#load_data').prepend(`<div class="row">
                       <div class="col-md-2">
                         <h6>${data.comment.name}</h6>
                              <small>${data.comment.created_at}</small>
                      </div>
                      <div class="col-md-10">
                          <p class="blockquote">${data.comment.body}</p>
                      </div>
                    </div>`);
              getCommentCount();
            }   
         }

       });

   });

/////////////////////////////////////////////////////////////////////////////////
});

function appendComment(data)
{

var $row='';
$.each(data,function(key,value){
            
$row+= `<div class="row">
     <div class="col-md-2">
       <h6>${value.name}</h6>
            <small>${value.created_at}</small>
    </div>
    <div class="col-md-10">
        <p class="blockquote">${value.body}</p>
    </div>
  </div>`;
 }); 
  return $row;


}

///////////////////////////////////////////////////////////////

function getCommentCount(){
  $.ajax({
         url:url+ '/getCommentCount',
         method:"get",
         data:{article_id:article_id},
         dataType:"json",
        
         success:function(data)
         {          
           $('#comment-count').html(data);
           
         }
       }); 
}