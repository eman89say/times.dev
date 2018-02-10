
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



///////////////////////////////Function upload Image//////////////////////////


function uploadImage(imgName) {

    if(document.getElementById(imgName).files[0] != null){


        var property = document.getElementById(imgName).files[0];
        var image_name= property.name;
        var image_extension=image_name.split('.').pop().toLowerCase();



        if(jQuery.inArray(image_extension,['gif','png','jpg','jpeg'])== -1){
         //
          alert("Invalid Image File");
        }

        var image_size= property.size;
        if(image_size > 2000000){
        //
          alert("Image File Size is very big");

        }

        else{

            return property;
        }
  }


}
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
///////////////////////////////////////////////////
