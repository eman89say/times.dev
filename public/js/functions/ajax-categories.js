var url= '/dashboard/categories';
var tableId= '#categories_table';

$(document).ready(function(){
   getCategories();


  $( "#add_category" ).click(function() {
       $( "#add_category_card" ).show( "slow" );
       $('#category_form')[0].reset();
       $('#form_output').html('');
         $('#button_action').val('insert');
         $('#action').val('Add');
        $('#card-title').text('Add New Category');

  });

  $('#cancel').click(function(){
       $( "#add_category_card" ).hide( "slow" );

  })

     $(document).on('click','.edit',function(){
       var id=$(this).attr("id");
          $.ajax({
          url:"/dashboard/categories/show",
          method:'get',
          data:{id:id},
          dataType:'json',
          success:function(data)
          {
            var id= data.id;
            $('#name').val(data.name);
            $( "#add_category_card" ).show( "slow" );
          $('#form_output').html('');
            $('#button_action').val('update');
            $('#action').val('Edit');
            $('#card-title').text('Edit Category Name');
            $('#category_id').val(id);

          }
       });
   

          
    }); 


   $('#category_form').on('submit',function(event){
       event.preventDefault();
       var button_action = $("#button_action").val();
       var id= $('input#category_id').val();

         var form_data={
                    ' _token':$("#category_form").find("input[name='_token']").val(),
                    'name':$('#name').val(),
                    'id':$('input#category_id').val(),
                    'button_action':button_action
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
              $('#form_output').html(showStaticNotification ('warning',data.error));
          }
          else
          {
              showNotification ('top','right','info', data.success);
              $('#category_form')[0].reset();
           $( "#add_category_card" ).toggle( "slow" );
           $('#output-error').html('');
           $(tableId).DataTable().ajax.reload();

           
          
            }   
         }

       });


   });


   $('#name').keyup(function(e){
         var form_data={
                    'name':$('#name').val(),
                     'id':$('input#category_id').val(),
                     };

        $.ajax({
         url:url+'/checkUnique',
         method:"get",
         data:form_data,
         dataType:"json",
         
         success:function(data)
         {          
         if(data.error.length>0)
          {
              $('#output-error').html(data.error);

          }
         else
           {
              $('#output-error').html('');
           
           }
         }

       });
   });


  

});



function getCategories(){
   $(tableId).DataTable({
       "processing":true,
       "serverSide":true,
       "ajax":url+"/getCategories",
       "lengthMenu": [[10, 20, -1], [10, 20, "All"]],
       "columns":[
            {"data":"name"},
            {"data":"created_at"},
            {"data":"action", orderable:false, searchable:false}
       ]
   });
}
