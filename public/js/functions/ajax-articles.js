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


   $('#add_article').click(function(){
      $('#articlesModel').modal('show');
      $('#article_form')[0].reset();
      $('#form_output').html('');
      $('#button_action').val('insert');
      $('#action').val('Add');
   });

   $('#article_form').on('submit',function(event){
       event.preventDefault();
       var form_data= $(this).serialize();
       $.ajax({
       	 url:"/dashboard/articles/postArticles",
       	 method:"POST",
       	 data:form_data,
       	 dataType:"json",
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
       	  	$('#title').val(data.title);
       	  	$('#body').val(data.body);
       	  	$('#article_id').val(id);
       	  	$('#articlesModel').modal('show');
       	  	$('#action').val('Edit');
       	  	$('.modal-title').text('Edit Article');
       	  	$('#button_action').val('update');
       	  }
       })
   });


   $(document).on('click','.delete',function(){
       var id=$(this).attr('id');
       if(confirm("Are you sure you want to delete this data?"))
       {
          $.ajax({
          	url:"/dashboard/articles/deleteArticle",
          	method:"get",
          	data:{id:id},
          	success:function(data)
          	{
              showNotification ('top','right','info', data);
              $('#articles_table').DataTable().ajax.reload();

          	}

          })
       }
       else
       {
       	return false;
       }
   });
});