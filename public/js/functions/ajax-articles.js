
$(document).ready(function(){

   $('#articles_table').DataTable({
       "processing":true,
       "serverSide":true,
       "ajax":"/dashboard/articles/getArticles",
       "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
       "columns":[
            {"data":"title"},
            {"data":"created_at"},
            {"data":"action", orderable:false, searchable:false}
       ]
   });

//////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////
   $('#add_article').click(function(){
     
      fetchCategories();
      fetchTags("#tags");
      $('textarea').ckeditor();
      CKEDITOR.instances['body'].setData('');
      $('#current_image').attr('src','');
      $('#articlesModel').modal('show');
      $('#article_form')[0].reset();
      $('#form_output').html('');
      $('#button_action').val('insert');
      $('#action').val('Add');
   });

   $('#article_form').on('submit',function(event){
       event.preventDefault();
      // var form_data= $(this).serialize();
       var form_data= new FormData();

      if(document.getElementById('cover_image').files[0] != null )
      {
       var property= uploadImage('cover_image');
       form_data.append('cover_image',property);
      }
         form_data.append(' _token',$('#article_form').find("input[name='_token']").val());
         form_data.append('title',$("#title").val());
         form_data.append('body',$("#body").val());
         form_data.append('button_action',$("#button_action").val());
         form_data.append('article_id',$('#article_id').val());
        form_data.append('category_id',$("#category_id").val());     

    
     var tags = $('#tags').tokenfield('getTokens');
     var tagId=[];
     $.each(tags,function(k,v){
      tagId[k]= v.key;
     }); 
  

        form_data.append('tagIds',tagId);


       $.ajax({
       	 url:"/dashboard/articles/postArticles",
       	 method:"POST",
       	 data:form_data,
       	 dataType:"json",
         contentType:false,
         cache:false,
         processData:false,
       	 success:function(data)
       	 {
       	 	if(data.error.length>0)
       	 	{
              $('#form_output').html(showStaticNotification ('warning',data.error));
       	 	}
       	 	else
       	 	{
              $('#articlesModel').modal('hide');
              showNotification ('top','center','success', data.success);
              $('#article_form')[0].reset();
              
              CKEDITOR.instances['body'].setData('');
              $('#current_image').attr('src','');
              $('#form_output').html('');
              $('#action').val('Add');
              $('.modal-title').text('Create New Article');
              $('#button_action').val('insert');
              $('#articles_table').DataTable().ajax.reload();
       	 	}
       	 }

       })
   });


   $(document).on('click','.edit',function(){
       var id=$(this).attr("id");
       $.ajax({
       	  url:"/dashboard/articles/fetchArticle",
       	  method:'get',
       	  data:{id:id},
       	  dataType:'json',
       	  success:function(data)
       	  {
       	  	var category_id= data.category_id;
            fetchCategories(category_id);
            $('#title').val(data.title);
       	  	$('#body').val(data.body);
            $('#current_image').attr('src',`/storage/cover_images/${data.cover_image}`);
       	  	$('#article_id').val(id);
            $('textarea').ckeditor();
       	  	$('#articlesModel').modal('show');
       	  	$('#form_output').html('');
       	  	$('#action').val('Edit');
       	  	$('.modal-title').text('Edit Article');
       	  	$('#button_action').val('update');

       	  }
       })
   });


   $(document).on('click','.delete',function(){
       var id=$(this).attr('id');
       swalDelete(id);
   });

});

function swalDelete(id){

  swal({
  title: "Are you sure?",
  text: "It will be deleted permanently!",
  icon: "warning",
  buttons: true,
  dangerMode: true, 
}).then((willDelete) => {
  if (willDelete) {
    $.ajax({
            url:"/dashboard/articles/deleteArticle",
            method:"get",
            data:{id:id},
            success:function(data)
            {
               swal("The Article has been deleted Successfuly!", {
               icon: "success",
                });
              $('#articles_table').DataTable().ajax.reload();
            }
        });   
  } 
});
}

/////////////////////////////////////////////////////////////////////

function fetchCategories(category_id=null){

  $('#category_id option').each(function() {
     $(this).remove();
      });
  $.ajax({
          url:"/dashboard/categories/getCategories",
          method:'get',
          dataType:'json',
          success:function(data)
          {
            var categories='';
             $.each(data, function (k,v) {
            
             $('#category_id').append(`<option value="${v.id}">${v.name}</option>`);
                if(category_id == v.id)
             {
               $('#category_id option').attr("selected","selected");
             }       

             });        

          }
       });
}

///////////////////////////////////////////////////////////////

function fetchTags(tagInputId){
    $.ajax({
          url:"/dashboard/tags/getTags",
          method:'get',
          dataType:'json',
          success:function(data)
          {
             
             setTokenfield(data,tagInputId);    
          }
       });

}

