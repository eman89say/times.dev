var url= '/dashboard/categories';

$(document).ready(function(){

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

    $(".edit").click(function() {
         var id= $(this).attr('id');
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
       console.log(button_action);
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
              showNotification ('top','right','success', data.success);
              $('#category_form')[0].reset();
	         $( "#add_category_card" ).toggle( "slow" );
	         $('#output-error').html('');

	         if(button_action == "insert"){
		         $('#categories_table').append(dataRow(data));
		     }
		      if(button_action == "update")
		      {
                   $('tr#'+id).replaceWith(dataRow(data));
		     }
            }   
       	 }

       });


   });


	 $('#name').keyup(function(e){
         var form_data={
                    'name':$('#name').val(),
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


function dataRow(data){
	var row=`<tr id="${data.category.id}"> <td > ${data.category.name}</td>
	<td><a id="${data.category.id}" class="edit btn btn-primary btn-simple btn-xs" href="#" 
	rel="tooltip" title="Edit Category Name"><i class="material-icons">edit</i></a></td>
	</tr>`;

	return row;
}