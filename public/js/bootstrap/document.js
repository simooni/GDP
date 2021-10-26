
let pageActuel = [0, 1];
// Get Nv from url
// var url = window.location.href;
// var code= url.split('/')[4];
var url_gdp='http://127.0.0.1:8000';
var coden= $('#id-nv').val();
var column= 'id';
var order= 'desc';
var idDossier ;
var nomfile;
const dossies = [ ];
const documents = [ ];


function vider(){
    $('.fileUpload input').val('');
    $('.form-group input').val('');
    $('#obsevation').val('');
    obsevation
    $('.uploadlogo').parent().children('span').html('<i class="fas fa-upload"></i> </br> Selectionner un fichier');
}
function hideAlert(){
    $('.alert-success').fadeOut(1500);
}

$("body").on("submit",".Vdocument-version", function() {
    $('#myModal').modal('show');
});


var size;
$("body").on('change', ".files",function() {
    size = this.files[0].size;
    nomfile= this.files[0].name ;
    console.log(this.files);
    alert(size);
});


// --------------------- Ajout --------------
$("body").on('click', ".tdocument-dossier",function(){ 
    idDossier = $(this).parent().parent().parent().siblings('.id-tdocument').text();
    
});

$("body").on('click', "#_ajouter_d",function(){
    idDossier = "";
});


$("body").on("submit", "form[name='tdocument']", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.
    var formData = new FormData(this);
    formData.append('size', size);
    formData.append('id_dossier', idDossier);
    formData.append('dossies', JSON.stringify(dossies));
    // formData.append('code', code);
    $('.televerser').hide();
    $('.pagination_document').hide();
    $('.loader').show();
    $.ajax({
        url:  $(this).attr('action'),
        type: "POST",
        data: formData, 

        success: function (result) {   
            if(result == 'ok'){
                column= 'id';
                order= 'desc';
                $('.success-add').show();
                $('.error-custom').hide();
                vider(); hideAlert();
                $('.loader').hide();
                $('.pagination_document').show();
                $('.televerser').show();
                getDocument(0, 1);
                $('body ').children('.button__pagination').removeClass('button__pagination__active')
                $("body ").children('.button__pagination').first().addClass('button__pagination__active');
                dossies.splice(0, dossies.length+1); 
                document.getElementById("demo").innerHTML = "";
                document.getElementById("multi-televerser").disabled = true;
            }else{
                for (const property in result) {
                    $('.error-custom').html('');
                    $('.'+property).html('<i class="fas fa-exclamation-triangle"></i>' + result[property]);
                    $('.'+property).show();

                    $('.loader').hide();
                    $('.televerser').show();
                    $('.pagination_document').show();
                    
                }
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });        
});

// -----------------------
var idVdocument ;
$("body").on('click', ".Vdocument-version",function(){
    idVdocument = $(this).parent().parent().parent().siblings('.id-tdocument').text();
});

$("body").on("submit", "form[name='tdocument_version']", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.

    

    var formData = new FormData(this);
    formData.append('size', size);
    formData.append('idVdocument', idVdocument);

    $('.televerser').hide();
    $('.pagination_document').hide();
    $('.loader').show();

    $.ajax({
        url:  $(this).attr('action'),
        type: "POST",
        data: formData,
        success: function (result) {
            if(result == 'ok'){
                $('.success-add').show();
                $('.error-custom').hide();
                vider(); hideAlert();
                getDocument(pageActuel[0], pageActuel[1]);
                $('.loader').hide();
                $('.pagination_document').show();
                $('.televerser').show();
            }else{
                for (const property in result) {
                    $('.error-custom').html('');
                    $('.'+property).html('<i class="fas fa-exclamation-triangle"></i>' + result[property]);
                    $('.'+property).show();
                   
                    $('.loader').hide();
                    $('.televerser').show();
                    $('.pagination_document').show();
                }
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });        
});



// --------------------- Supprimer --------------

var docSelectionne ;

$('body').on('click','.tr-parent', function(){
    // $('.tr-parent').css('background-color','white');
    // $(this).css('background-color','#ddd');
    docSelectionne = $( this ).find("td:eq(1)").text();
    // alert($('.Tdocument-suspendre').attr('action'));
    // $('.Tdocument-suspendre').attr('action','/tdocument/suspendre/12');
});

$("body").on("submit", "form[name='Tdocument-suspendre']", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.
    
    // var r = confirm("Vous êtes sûr que vous voulez Supprimer ce document?");
    // if (r == true) {

        Swal.fire({
            title: 'Vous êtes sûr? ',
            text: "que vous voulez Supprimer ce document?",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Fermer !',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui !'
        }).then((result) => {
            if (result.isConfirmed) {
                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    success: function (result) {
                        if(result == 'ok'){
                            getDocument(pageActuel[0], pageActuel[1]);
                            getAction(pageActuel[0], pageActuel[1]);
                            $('.docoments-success').html('<i class="fas fa-check"></i> Le document a été Supprimé avec succès');
                            $('.docoments-success').show();
                            setTimeout(() => {
                                $('.docoments-success').hide();
                            }, 2000)
                            // $('#td'+docSelectionne).hide();
                            

                        }else{
                            $('docoments-errors').show();
                            setTimeout(() => {
                                $('docoments-errors').hide();
                            }, 2000)
                        }   
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }  
        })       
});

// --------------------- cloturer --------------

$("body").on("submit", "form[name='Tdocument-cloturer']",function(ev) {
    ev.preventDefault(); // Prevent browser default submit.

    Swal.fire({
        title: 'Vous êtes sûr? ',
        text: "que vous voulez cloturer ce document?",
        // icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Fermer !',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Oui !'
    }).then((result) => {
        if (result.isConfirmed) {

            var formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                success: function (result) {
                    if(result == 'ok'){
                        
                        $('.docoments-success').html('<i class="fas fa-check"></i> Le document a été clôturé avec succès');
                        $('.docoments-success').show();
                        setTimeout(() => {
                            $('.docoments-success').hide();
                        }, 2000)
                        // $('#td'+docSelectionne).hide();
                        // setTimeout(function(){  location.reload(); }, 100);
                        
                        getDocument(pageActuel[0], pageActuel[1]);
                    

                    }else{
                        $('.docoments-errors').show();
                        setTimeout(() => {
                            $('.docoments-errors').hide();
                        }, 2000)
                    }   
                },
                cache: false,
                contentType: false,
                processData: false
            });
            
        }
    })


});

// --------------------- annuler --------------//

$("body").on("submit", "form[name='Tdocument-annuler']",function(ev) {
    ev.preventDefault(); // Prevent browser default submit.
   

    // var r = confirm("Vous êtes sûr que vous voulez annuler ce document?");
    // if (r == true) {
        Swal.fire({
            title: 'Vous êtes sûr? ',
            text: "que vous voulez annuler ce document?",
            // icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Fermer !',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui !'
        }).then((result) => {
            if (result.isConfirmed) {

                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    success: function (result) {
                        if(result == 'ok'){
                            
                            $('.docoments-success').html('<i class="fas fa-check"></i> Le document a été annulé avec succès');
                            $('.docoments-success').show();
                            setTimeout(() => {
                                $('.docoments-success').hide();
                            }, 2000)
                            // $('#td'+docSelectionne).hide();
                            // setTimeout(function(){  location.reload(); }, 100);
                            getDocument(pageActuel[0], pageActuel[1]);

                        }else{
                            $('docoments-errors').show();
                            setTimeout(() => {
                                $('docoments-errors').hide();
                            }, 2000)
                        }   
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        })        
});
// -----------------------------------//

// ---------------- modifier statut --------------//

$("body").on("submit", "form[name='Tdocument-statuts']",function(ev) {
    
    ev.preventDefault(); // Prevent browser default submit.
    // var r = confirm("Vous êtes sûr que vous voulez changer statut de ce document?");
    // if (r == true) {

        Swal.fire({
            title: 'Vous êtes sûr? ',
            text: "que vous voulez changer statut de ce document?",
            // icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Fermer !',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Oui !'
        }).then((result) => {
            if (result.isConfirmed) {        

                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    success: function (result) {
                        if(result == 'ok'){
                            
                            $('.docoments-success').html('<i class="fas fa-check"></i> Le document a été changer statut avec succès');
                            $('.docoments-success').show();
                            setTimeout(() => {
                                $('.docoments-success').hide();
                            }, 2000)
                            // $('#td'+docSelectionne).hide();
                            // setTimeout(function(){  location.reload(); }, 100);
                            getDocument(pageActuel[0], pageActuel[1]);

                        }else{
                            $('docoments-errors').show();
                            setTimeout(() => {
                                $('docoments-errors').hide();
                            }, 2000)
                        }   
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            }
        }) 
});
// -----------------------------------//


// --- modifier statut ----------

// var page = 0;
// //   var scroll = 10000;
// $("body").on('click', ".voir-plus",function(){
//         page = page +10;
//         // var s = Math.floor($(window).scrollTop()) - 115;
//         $.ajax({
//             type:'POST',
//             url:"http://localhost:8000/home",
//             data:{page:page},
//             success:function(html){
//                 $('.TbodyDocument').append(html); 
//                 // window.scrollTo(0,s);
//             }
//         });   
// });  

$("body").on('click', ".filter-button-tdocument",function(){
    $(".filter-tdocument").slideToggle(400);
});

// -------------------- modifier edit --------------

var id;
var intitule ;
var statut ;
$("body").on('click', ".modifier-tdocument",function(){

    
    id         = $(this).parent().parent().parent().siblings('.id-tdocument').text();
    intitule   = $(this).parent().parent().parent().siblings('.intitule-tdocument').text();
    type       = $(this).parent().parent().parent().siblings('.type-tdocument').text();
    avancement = $(this).parent().parent().parent().siblings('.avancement-tdocument').text();
    statut     = $(this).parent().parent().parent().siblings('.statut-tdocument').text();
    if(type=='Dossier'){
        document.getElementById("type-edit").innerHTML = 'un dossier';  
    }
    else{
        document.getElementById("type-edit").innerHTML = 'le document';
    }
     
    $('#tdocument-edit #intitule').val(intitule);
    $('#tdocument-edit #id').val(id);
    // $('#tdocument-edit #testh5').innerHTML = type;
    $('#avancement-document option[value="'+avancement+'"]').attr('selected','selected');
    $('#statut-document option[value="'+statut+'"]').attr('selected','selected');
    
    // ('option[value=".statut-tdocument"').attr('selected','selected');

});


$("body").on("submit", "form[name='tdocument-edit']", function(ev) {
        ev.preventDefault(); // Prevent browser default submit.
        var formData = new FormData(this);
       
        $('.televerser').hide();
        $('.pagination_document').hide();
        $('.loader').show();
        $.ajax({
            url: url_gdp+"/tdocument/"+id+"/edit",
            type: "POST",
            data:formData,
            
            success: function (result) {
                if(result == 'ok'){
                    $('.error-custom').hide();
                    $('.success-add').show();
                    hideAlert();
                    $('.loader').hide();
                    $('.televerser').show();
                    $('.pagination_document').show();
                    getDocument(pageActuel[0], pageActuel[1]);
                    // setTimeout(function(){   $('#Tdocument-edit').modal('hide'); }, 400);
                   

                }else{
                    for (const property in result) {
                        $('.error-custom').html('');
                        $('.'+property).html('<i class="fas fa-exclamation-triangle"></i>' + result[property]);
                        $('.'+property).show();

                        $('.loader').hide();
                        $('.televerser').show();
                        $('.pagination_document').show();
                    }
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });        
});

     
     


// ----- for pagination ----//

function getDocument(page, i) {
    pageActuel = [page, i];
    
    console.log(pageActuel[0]);
    if(page != 0) {
        $('.pagination_document').hide();
        $(".loader").show();
    }
    axios.post(url_gdp+'/home?limit='+page+'&category=document&code='+coden+'&column='+column+'&order='+order)
    .then((suc) => {
        $(".TbodyDocument").empty();
        $(".TbodyDocument").html(suc.data);

        $(".loader").hide();
        $('.retour_document').hide();
        $('.pagination_document').show();  
        $('.modal').modal('hide')
    })
    .catch((err) => {
        console.log(err)
        $(".loader").hide();
        $('.pagination_document').show();
    })
}
// ----- for pagination ----//


// ---- trier par column ----//

$("body").on('click', ".Tdocument-th",function(){
    var th_val =$(this).text();
    var page = $('> .num-page-Document','.button__pagination__active').val();
    column = $('> .th_column',this).val();
    if($('.order_th').val()== 'desc'){
        document.getElementById("order_th").value = "ASC";
    }
    else{
        document.getElementById("order_th").value = "desc";
    }
    order =$('.order_th').val();

    $('.pagination_document').hide();
    $(".loader").show();
    // alert('order:'+order +'  thval:'+th_val+'  limit:'+ page+'  column:'+  column +'  coden:'+coden);
    axios.post(url_gdp+'/home?limit='+page+'&category=document&code='+coden+'&column='+column+'&order='+order)
    .then((suc) => {
        $(".TbodyDocument").empty();
        $(".TbodyDocument").html(suc.data);
        
        $(".loader").hide();
        $('.pagination_document').show();
    })
    .catch((err) => {
        console.log(err)
        $(".loader").hide();
        $('.pagination_document').show();
    })
});

$("body").on('click', ".show_plus",function(){ 
    // idDossier = $(this).siblings('.id-tdocument').text();
        // id_dossier_doc_plus = $(this).parent().siblings('.id-tdocument').text();
        id_dossier_doc_plus = $(this).siblings('.id-tdocument').text();
        $(".prog").addClass("progress1");
        $(this).removeClass("show_plus").addClass("show_p");
        $("."+id_dossier_doc_plus).empty();
    axios.post(url_gdp+'/home?id_dossier_doc_plus='+id_dossier_doc_plus)
    .then((suc) => {
        
         $("."+id_dossier_doc_plus).html(suc.data);

        $(".prog").removeClass("progress1");
        
        
    })
    .catch((err) => {
        console.log(err)
        
    })
});

$("body").on('click', ".show_p",function(){ 
    $(this).removeClass("show_p").addClass("show_plus");
});



// $("body").on('click', ".fa-file",function(){ 
//     $(this).removeClass("fa-file").addClass("fa fa-files-o");
// });

// $("body").on('click', ".fa-files-o",function(){ 
//     $(this).removeClass("fa fa-files-o").addClass("fa-file");
// });




// multi dossier 

$('body').on('click','.ajouter_multi_dossier',function() {
var intitule= document.getElementById("ajout_intitule").value;

if(intitule!=''){
    var myObject = {
        'id': dossies.length, 
        'intitule': intitule
    }
    dossies.push(myObject) ;
    
   
    var html1= '<table id=table-data"  class="table table-bordered mt-2  table_home prog table_multi_ajout"  style="width:388px">';
    html1 +='<thead class="bg-light" >';
    html1 +='<tr class="tr_table"> ';
    html1 +='<th > Num </th> <th > Intitule </th> <th > Supprimer </th>';
    html1 +='</tr> ';
    html1 +='</thead>';
    j=1;
        for(var i=0 ; i<dossies.length; i++)
    {
        html1 +="<tr>"
        html1 +='<td>'+ j++ +'</td>';
        html1 +="<td>"+dossies[i]['intitule']+"</td>";
        html1 +='<td> <button type="button" class="supprimer_dossier" name="'+dossies[i]['id']+'" style="border:none; background-color:transparent; outline:none;"><i class="fa fa-trash-o" style="color:red;font-size:14px"></i></button></td>'; 
    
        
        html1 +="</tr>" ;
    }
    html1 +="</table>";

    document.getElementById("demo").innerHTML = html1;
    document.getElementById("multi-televerser").disabled = false;
}
else if(dossies[0]==null){
    document.getElementById("demo").innerHTML = '<div class="alert alert-danger alert_intitule" role="alert" >Veuillez remplir le champ!</div>';
    document.getElementById("multi-televerser").disabled = true;
}
 console.log(dossies);
});

$('body').on('click','.supprimer_dossier',function() {
  
    var id = $(this).attr('name'); 
    

    for(var i=0 ; i<dossies.length; i++){ 
   
        if ( dossies[i]['id'] == id) { 
           
            dossies.splice(i, 1); 
        }  
  }
    if(dossies[0]!=null){
        var html1= '<table id=table-data"  class="table table-bordered mt-2  table_home prog table_multi_ajout"  style="width:388px">';
        html1 +='<thead class="bg-light" >';
        html1 +='<tr class="tr_table"> ';
        html1 +='<th > Num </th> <th > Intitule </th> <th > Supprimer </th>';
        html1 +='</tr> ';
        html1 +='</thead>';
        j=1;
            for(var i=0 ; i<dossies.length; i++)
        {
            html1 +="<tr>"
            html1 +='<td>'+ j++ +'</td>';
            html1 +="<td>"+dossies[i]['intitule']+"</td>";
            html1 +='<td> <button type="button" class="supprimer_dossier" name="'+dossies[i]['id']+'" style="border:none; background-color:transparent; outline:none;"><i class="fa fa-trash-o" style="color:red;font-size:14px"></i></button></td>'; 
        
            
            html1 +="</tr>" ;
        }
        html1 +="</table>";
        document.getElementById("demo").innerHTML = html1;
    }else{
        document.getElementById("demo").innerHTML = '';
        document.getElementById("multi-televerser").disabled = true;
    }
});

// multi document

$('body').on('click','.ajouter_multi_document',function() {
    var intitule= document.getElementById("ajout_intitule_document").value;
 
    if(intitule!='' && nomfile!=''){
        var myObject = {
            'id': documents.length, 
            'intitule': intitule,
            'file': nomfile
        }
        documents.push(myObject) ;
        console.log(documents);
       
        var html1= '<table id=table-data"  class="table table-bordered mt-2  table_home prog table_multi_ajout"  style="width:388px">';
        html1 +='<thead class="bg-light" >';
        html1 +='<tr class="tr_table"> ';
        html1 +='<th > Num </th> <th > Intitule </th> <th > File </th> <th > Supprimer </th>';
        html1 +='</tr> ';
        html1 +='</thead>';
        j=1;
            for(var i=0 ; i<documents.length; i++)
        {
            html1 +="<tr>"
            html1 +='<td>'+ j++ +'</td>';
            html1 +="<td>"+documents[i]['intitule']+"</td>";
            html1 +="<td>"+documents[i]['file']+"</td>";
            html1 +='<td> <button type="button" class="supprimer_multi_document" name="'+documents[i]['id']+'" style="border:none; background-color:transparent; outline:none;"><i class="fa fa-trash-o" style="color:red;font-size:14px"></i></button></td>'; 
        
            
            html1 +="</tr>" ;
        }
        html1 +="</table>";
    
        document.getElementById("demo_documet").innerHTML = html1;
        document.getElementById("multi-televerser-document").disabled = false;
        document.getElementById("message_documet").innerHTML = "";
    }
    else if(documents[0]==null){
        document.getElementById("demo_documet").innerHTML = '<div class="alert alert-danger alert_intitule" role="alert" >Veuillez remplir le champ!</div>';
        document.getElementById("multi-televerser-document").disabled = true;
        document.getElementById("message_documet").innerHTML = "";
    }
    else if(intitule==''){
        document.getElementById("message_documet").innerHTML = "<div class='alert alert-danger alert_intitule' role='alert' >Veuillez remplir l'intitule!</div>";
       
    }
    else if(nomfile==''){
        document.getElementById("message_documet").innerHTML = "<div class='alert alert-danger alert_intitule' role='alert' >Veuillez selectionner un fichier!</div>";
        
    }
    
     
    });

    $('body').on('click','.supprimer_multi_document',function() {
  
        var id = $(this).attr('name'); 
        
    
        for(var i=0 ; i<documents.length; i++){ 
       
            if ( documents[i]['id'] == id) { 
               
                documents.splice(i, 1); 
            }  
        }
        if(documents[0]!=null){
            var html1= '<table id=table-data"  class="table table-bordered mt-2  table_home prog table_multi_ajout"  style="width:388px">';
            html1 +='<thead class="bg-light" >';
            html1 +='<tr class="tr_table"> ';
            html1 +='<th > Num </th> <th > Intitule </th> <th > File </th> <th > Supprimer </th>';
            html1 +='</tr> ';
            html1 +='</thead>';
            j=1;
                for(var i=0 ; i<documents.length; i++)
            {
                html1 +="<tr>"
                html1 +='<td>'+ j++ +'</td>';
                html1 +="<td>"+documents[i]['intitule']+"</td>";
                html1 +="<td>"+documents[i]['file']+"</td>";
                html1 +='<td> <button type="button" class="supprimer_multi_document" name="'+documents[i]['id']+'" style="border:none; background-color:transparent; outline:none;"><i class="fa fa-trash-o" style="color:red;font-size:14px"></i></button></td>'; 
            
                
                html1 +="</tr>" ;
            }
            html1 +="</table>";
            document.getElementById("demo_documet").innerHTML = html1;
        }else{
            document.getElementById("demo_documet").innerHTML = '';
            document.getElementById("multi-televerser-document").disabled = true;
        }
    });