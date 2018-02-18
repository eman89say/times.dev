var formId = '#comment_form';
var url= '/article/comments';

$(document).ready(function(){

	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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

                     console.log($(this).attr('id'));

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

            }   
         }

       });

   });

/////////////////////////////////////////////////////////////////////////////////
});