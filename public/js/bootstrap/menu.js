// ####################################################""

$(".link-niveau").on("click", function() {
    coden = $('> .code-link',this).val();
    var nv= $(this).text();
   var test='<span class="home">Home</span><i class="fas fa-angle-right p-1"></i><span>'+nv+'</span>'
   
   $("#show_loader")[0].removeAttribute("hidden");
   axios.post('http://127.0.0.1:8000/home?code='+coden)
   .then((res) => {
       console.log(res.data)
       $(".contenu-index").empty();
       $(".contenu-index").html(res.data);
       $(".lien-active").empty();
       $(".lien-active").empty().append(test); 
       $('.link-niveau').removeClass('link_active')
       $(this).addClass('link_active')
       $("#show_loader").attr("hidden",true);
       // getDocument(code, pageActuel[0], pageActuel[1]);
   })
   .catch((err) => {
       console.log(err)
   })
   

 });
//   ################################################
