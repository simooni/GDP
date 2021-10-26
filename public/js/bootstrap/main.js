 

// $( "#tttest" ).click(function() {
//   $("#navigation").even().removeClass( "active" );
//   $("#tableau").even().removeClass( "active" );

// });
function toggleSidebar(ref){ 
  document.getElementById("tableau").classList.toggle('active');
  document.getElementById("navigation").classList.toggle('active');
   
}  

$( ".nvc" ).click(function() {
  if($(this).hasClass("fa-minus")) {
    // $(this).val('id').removeClass('fa-minus');
    $(this).removeClass("fa-minus").addClass("fa-plus");
  }
  else{
  $(this).val('id').removeClass('fa-plus');;
  $(this).addClass("fa-minus");
}

});

$( ".navigation-item .navigation-icon" ).click(function() {
    $( ".navigation-item .navigation-icon" ).parent().removeClass('active');
    // $(this).closest(".navigation-item .item").first().addClass("gris");

    var ul  = $(this).parent().next();
    ul.slideToggle();

});


// $( ".nv" ).click(function() {
    
//     $( ".nv" ).find('div:eq(1)').removeClass('active');
//     $(this).find('div:eq(1)').addClass("active");
//     $( ".nv" ).find('div:eq(1)').not('.active').slideUp();
//     $(".nv" ).find('div').removeClass("gris");
//     $(this).find('div:eq(0)').addClass("gris");

// });
$('body').on('click','.plus',function() {
    $(this).parent().next('.version').slideToggle();

});




// ------------- upload files ---------

    //  var x = document.referrer;
    //  if(x){
    //   window.open("https://www.w3schools.com");
    //  }

    // Upload btn on change call function
    $("body").on("change",".uploadlogo", function() {
        var filename = readURL(this);
        $(this).parent().children('span').html(filename);
      });
    
      // Read File and return value  
      function readURL(input) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        // if (input.files && input.files[0] && (
        //   ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "gif" || ext == "pdf" ||  ext == "mp4"
        //   )) {
        
        // var len = input.files.length;
        // var i=0;
        // for( i ; i< len ; i++){
        //     console.log(input.files[i]['name']);
        // }
  
        if (input.files && input.files[0]) {
          var path = $(input).val();
          var filename = path.replace(/^.*\\/, "");
          // $('.fileUpload span').html('Uploaded Proof : ' + filename);
          // return "Uploaded file : "+filename;
          var len = input.files.length;
          var i = 0;
          var filename = "";
          for( i ; i< len ; i++){
            filename = filename + input.files[i]['name'] + "</br>";
          }
  
          return ""+filename;
        } 
        // else {
        //   $(input).val("");
        //   return "Only mp4/image/pdf formats are allowed!";
        // }
      }
      // Upload btn end
    

      $('body').on({
        mouseenter: function() {
          $( this ).append( $( "<i class='fa fa-eye'></i>" ) );
        },
        mouseleave: function() {
          $( this ).find( "i" ).last().remove();
        }
      }, '.show_document_action');

// ------------- upload files ---------
