var url= '/dashboard/userProfile';
var formId = '#profile_form';


$(formId).on('submit',function(event){
       event.preventDefault();
       var form_data={
                    ' _token':$(formId).find("input[name='_token']").val(),
                    'user_id': $('#user_id').val(),
                    'first_name':$('#first_name').val(),
                    'last_name':$('#last_name').val(),
                    'address':$('#address').val(),
                    'job_title':$('#job_title').val(),
                    'about':$('#about').val(),
                    'id': $('#profile_id').val()
                     };

       $.ajax({
       	 url:url,
       	 method:"POST",
       	 data:form_data,
       	 dataType:"json",
         
       	 success:function(data)
       	 {      	 	
           showNotification ('top','right','success', data.success);

           $('#newTitle').text(data.fields.job_title);
           $('#newName').text(data.fields.first_name+ ' '+data.fields.last_name );
           $('#newAbout').text(data.fields.about);
                
       	 }

       });
  
 }); 

$(document).on('change','#userImage',function(){

    var form_data2= new FormData();

   
       var property= uploadImage('userImage');
       form_data2.append('user_image',property);
        form_data2.append('id',$('#profile_id').val());
                 form_data2.append(' _token',$('#uploadProfileImgForm').find("input[name='_token']").val());




          $.ajax({
                     url:url+'/uploadProfileImg',
                     method:"POST",
                     data:form_data2,
                     contentType:false,
                     cache:false,
                     processData:false,
                    dataType:"json",
                     success:function(data){
                                 showNotification ('top','right','success', data.success);
                      $("img.profileImg").attr('src',`/storage/users_images/${data.profileImg}`);
                     }

          })
});

     