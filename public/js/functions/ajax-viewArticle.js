  var tableId= '#comments_table';

  $(document).ready(function(){
 
    var id=$('#article_id').val();

       $.ajax({
         url:"/dashboard/articles/fetchArticle",
         method:"get",
         data:{id:id},
         dataType:"json",
        
         success:function(data)
         {
          $('#title').text(data.title);
          $('#category').text(data.category);
          $('#user').text(data.user);
          $('#date').text(data.date);
          $('#body').html(data.body);
          $('#url').attr('href','/articles/'+data.category+'/'+data.slug);

           $.each(data.tags, function (k,v) {
                    $('#tags').append(`<li class="label label-info">${v}</li>   `);
              });

          $('img').attr('src',`/storage/cover_images/${data.cover_image}`);


         }
       });


///////////////////////////////////////////////////////////////////////////////////

$(tableId).DataTable({
       "processing":true,
       "serverSide":true,
       "ajax":'/dashboard/articles/'+id+'/comments/getComments',
       "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
       "columns":[
            {"data":"body"},
            {"data":"created_at"},
            {"data":"approved", orderable:false, searchable:false},
            {"data":"action", orderable:false, searchable:false},
            {"data":"view", orderable:false, searchable:false},
       ]
   });

/////////////////////////////////////////////////////////////////////////
   $(document).on('click','.view',function(){
       var id=$(this).attr("id");
       $.ajax({
          url:"/dashboard/comments/fetchComment",
          method:'get',
          data:{id:id},
          dataType:'json',
          success:function(data)
          {
            console.log(data);
            $('h5#name').html(`<strong>From : </strong>${data.name}`);
            $('h6#date').html(`<strong>Date : </strong>${data.date}`);
            $('p#body').html(`<strong>Comment : </strong>${data.body}`);

            $('#commentModel').modal('show');

          }
       })
   });

//////////////////////////////////////////////////////////
$(document).on('click','.publish',function(){
       var id=$(this).attr("id");
       var button_action= 'publish';
       $.ajax({
          url:"/dashboard/comments/publish",
          method:'get',
          data:{id:id , button_action: button_action},
          dataType:'json',
          success:function(data)
          {
            $(tableId).DataTable().ajax.reload();
              showNotification ('top','right','info', data.success);

          }
       })
   });

//////////////////////////////////////////////////////////////

$(document).on('click','.unPublish',function(){
       var id=$(this).attr("id");
       var button_action= 'unPublish';
       $.ajax({
          url:"/dashboard/comments/publish",
          method:'get',
          data:{id:id , button_action: button_action},
          dataType:'json',
          success:function(data)
          {
            $(tableId).DataTable().ajax.reload();
              showNotification ('top','right','info', data.success);

          }
       })
   });


////////////////////////////////////////////////////////////


 });
