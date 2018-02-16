
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


/////////////////////////Notification Functions ///////////////////////////
function showNotification (from, align,type, message) {

    $.notify({
          icon: "notifications",
        message: message
    }, {
        type: type,
        timer: 4000,
        placement: {
            from: from,
            align: align
        }
    });
}

//////////////////////////////////////////////////////////////////////////////
function showStaticNotification (type,data){
  if(data!=null){

              var errorlist=  '<ul>';
             $.each(data, function (k,v) {
               errorlist+= `<li>${v}</li>`
                })
                errorlist += '</ul>';


  


   var rows = `<div class="alert alert-${type}">
                                        <button type="button" aria-hidden="true" class="close">×</button>
                                        <span>
                                            <b> ${type} - </b>${errorlist}</span>
                                    </div>`;
    return rows;
}
}
///////////////////////////////////////////////////////////////////////////////////
function setTokenfield(data,tagInputId)
{
  var tagsArray=[];
     $.each(data,function(k,v){
      tagsArray[k]= {key:v.id, value: v.name};
     }); 

 var engine = new Bloodhound({
  local:tagsArray ,
  datumTokenizer: function(d) {
    return Bloodhound.tokenizers.whitespace(d.value);
  },
  queryTokenizer: Bloodhound.tokenizers.whitespace
});

engine.initialize();

$(tagInputId).tokenfield({
  typeahead: [null, { source: engine.ttAdapter() }]
});

$(tagInputId).on('tokenfield:createtoken', function (event) {
  var existingTokens = $(this).tokenfield('getTokens');
  $.each(existingTokens, function(index, token) {
    if (token.value === event.attrs.value)
      event.preventDefault();
  });
});
}


/////////////////////////////////////////////////


//////////////////////////////////swal Delete Pop message//////////////////////
function swalDelete(id,url,tableId){

  swal({
  title: "Are you sure?",
  text: "It will be deleted permanently!",
  icon: "warning",
  buttons: true,
  dangerMode: true, 
}).then((willDelete) => {
  if (willDelete) {
    $.ajax({
            url:url,
            method:"get",
            data:{id:id},
            success:function(data)
            {
               swal("The Data has been deleted Successfuly!", {
               icon: "success",
                });
              $(tableId).DataTable().ajax.reload();
            }
        });   
  } 
});
}
///////////////////////////////////////////////////////////////////////////


///////////////////////////////Function upload Image//////////////////////////


function uploadImage(imgName) {

    if(document.getElementById(imgName).files[0] != null){


        var property = document.getElementById(imgName).files[0];
        var image_name= property.name;
        var image_extension=image_name.split('.').pop().toLowerCase();



        if(jQuery.inArray(image_extension,['gif','png','jpg','jpeg'])== -1){
         //
           showNotification ('top','right','info', "Invalid Image File");

        }

        var image_size= property.size;
        if(image_size > 2000000){
        //
           showNotification ('top','right','info', "Image File Size is very big");

        }

        else{

            return property;
        }
  }


}