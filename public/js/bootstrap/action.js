
// Get Nv from url
    // var url = window.location.href;
    // var code= url.split('/')[4];
    var url_gdp='http://127.0.0.1:8000';
    var coden= $('#id-nv').val();  
    var column= 'id';
    var order= 'desc';

$("body").on('click', ".filter-button-action",function(){
    $(".filter-taction").slideToggle(400);
});

function viderAction(){
    $('#typeAction').val('');
    $('#urgence').val('');
    $('.form-group input').val('');
    $('#obsevation').val('');

}

$("body").on('click', ".fermer-modal , .close",function(){
    viderAction();
    $('.error-custom').hide();
});

// --------------------- Ajout action --------------

let pageActuelAction = [0, 1];

$("body").on("submit","form[name='taction']", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.
    var formData = new FormData(this);
    
    // formData.append('code', coden);
    $('.ajouter-action').hide();
    $('.pagination_action').hide();
    $('.loader').show();
    alert(idDossier);
    formData.append('id_dossier', idDossier);

    $.ajax({
        url:  $(this).attr('action'),
        type: "POST",
        data: formData,
        success: function (result) {
            if(result == 'ok'){
                $('.error-custom').hide();
                $('.success-add').show();
                viderAction(); hideAlert();
                column= 'id';
                order= 'desc';
                getAction(0,1);
                $('.ajouter-action').show();
                $('.loader').hide();
                $('.pagination_action').show();
            }else{
                $('.error-custom').html('');
                for (const property in result) {
                    $('.'+property).html('<i class="fas fa-exclamation-triangle"></i>' + result[property]);
                    $('.'+property).show();

                    $('.ajouter-action').show();
                    $('.loader').hide();
                    $('.pagination_action').show();
                }
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });        
});


// ----------------------
var taction ;
$("body").on('click', ".taction_reponse",function(){
    taction = $(this).parent().parent().parent().siblings('.id-taction').text();
    // alert(taction);
});



$("body").on("submit", "form[name='taction_reponse']", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.
    var formData = new FormData(this);
    formData.append('taction', taction);
    formData.append('size', size);
  
    $('.televerser').hide();
    $('.pagination_action').hide();
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
                getAction(pageActuelAction[0], pageActuelAction[1])
                $('.loader').hide();
                $('.televerser').show();
                $('.pagination_action').show();
            }else{
                for (const property in result) {
                    $('.error-custom').html('');
                    $('.'+property).html('<i class="fas fa-exclamation-triangle"></i>' + result[property]);
                    $('.'+property).show();
                  
                    $('.televerser').show();
                    $('.loader').hide();
                    $('.pagination_action').show();
                }
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });        
});
// --------------------- Ajout action --------------

// --------------------- Supprimer action --------------

var docSelectionne ;

$('body').on('click','.tr-parent', function(){
    // $('.tr-parent').css('background-color','white');
    // $(this).css('background-color','#ddd');
    docSelectionne = $( this ).find("td:eq(1)").text();
    // alert($('.Taction-suspendre').attr('action'));
    // $('.Taction-suspendre').attr('action','/Taction/suspendre/12');
});

$("body").on("submit", "form[name='Taction-suspendre']" ,function(ev) {
    ev.preventDefault(); // Prevent browser default submit.

    // var r = confirm("Vous êtes sûr que vous voulez Supprimer cet action?");
    // if (r == true) {

        Swal.fire({
            title: 'Vous êtes sûr? ',
            text: "que vous voulez Supprimer cet action?",
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
                            $('.actions-success').html("<i class='fas fa-check'></i> L'action' a été Supprimé avec succès");
                            $('.actions-success').show();
                            setTimeout(() => {
                                $('.actions-success').hide();
                            }, 2000)
                            // $('#td'+docSelectionne).hide();
                            // location.reload(); 
                            getAction(pageActuelAction[0], pageActuelAction[1])

                        }else{
                            $('.actions-errors').show();
                            setTimeout(() => {
                                $('.actions-errors').hide();
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

// --------------------- --------------------------


// --------------------- cloturer action --------------

$("body").on("submit","form[name='Taction-cloturer']", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.

    // var r = confirm("Vous êtes sûr que vous voulez cloturer cet action?");
    // if (r == true) {

        Swal.fire({
            title: 'Vous êtes sûr? ',
            text: "que vous voulez cloturer cet action?",
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
                            
                            $('.actions-success').html("<i class='fas fa-check'></i> L'action a été clôturé avec succès");
                            $('.actions-success').show();
                            setTimeout(() => {
                                $('.actions-success').hide();
                            }, 2000)
                            // $('#td'+docSelectionne).hide();
                            // setTimeout(function(){  location.reload(); }, 100);
                            getAction(pageActuelAction[0], pageActuelAction[1])

                        }else{
                            $('.actions-errors').show();
                            setTimeout(() => {
                                $('.actions-errors').hide();
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



// --------------------- modifier action --------------
// $('.modifier-taction').click()

$('body').on('click','.modifier-taction', function(){

    var id = $( this ).attr('id');
    
    $('.enregistrer-action').hide();
    $.ajax({
        url: url_gdp+'/taction/current/'+id,
        type: "POST",
        success: function (result) {
           
        //    console.log(result);
           $('#action-intitule').val(result['intitule']);
           $('#action-typeAction option[value='+result['Taction']+']').attr('selected','selected');
           $('#action-urgence option[value='+result['etatUrgence']+']').attr('selected','selected');
           $('.enregistrer-action').show();

        },
        cache: false,
        contentType: false,
        processData: false
    });

});

var id;
$("body").on('click',".modifier-taction",function(){
    id = $(this).parent().parent().parent().siblings('.id-taction').text();
});

$("body").on("submit","form[name='Taction-edit']",function(ev) {
    ev.preventDefault(); // Prevent browser default submit.
    var formData = new FormData(this);

    $('.enregistrer-action').hide();
    $('.pagination_action').hide();
    $('.loader').show();
    $.ajax({
        url:  url_gdp+"/taction/" +id +"/edit",
        type: "POST",
        data: formData,
        success: function (result) {
            if(result == 'ok'){
                $('.error-custom').hide();
                $('.success-add').show();
                hideAlert();
                getAction(pageActuelAction[0], pageActuelAction[1])
                $('.loader').hide();
                $('.enregistrer-action').show();
                $('.pagination_action').show();
                

            }else{
                for (const property in result) {
                    $('.error-custom').html('');
                    $('.'+property).html('<i class="fas fa-exclamation-triangle"></i>' + result[property]);
                    $('.'+property).show();

                    $('.enregistrer-action').show();
                    $('.loader').hide();
                    $('.pagination_action').show();
                }
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });        
});



// --------------------- show document action --------------
$("body").on('click',".show_document_action",function(){
    id = $('> .document-show',this).val();
    var code= $('#id-nv').val(); 
    $(".loader").show();
   axios.post(url_gdp+'/home?id='+id+'&code='+code)
   .then((res) => {
        $(".contenu-index").empty();
        $(".contenu-index").html(res.data);
        $(".loader").hide(); 
        $('.pagination_document').hide();
        $('.retour_document').show();
        if(!$("#navigation").hasClass('active') && $("#tableau").hasClass('active') ){
            document.getElementById("tableau").classList.toggle('active');
        }
       // getDocument(code, pageActuel[0], pageActuel[1]);
   })
   .catch((err) => {
       console.log(err)
   })
   

 });
 
 // --------------------- -------------- ------------

// ---------------------- modifier statut ----------

 $("body").on("submit", "form[name='Taction-statuts']",function(ev) {
    
    ev.preventDefault(); // Prevent browser default submit.
    // var r = confirm("Vous êtes sûr que vous voulez changer statut ?");
    // if (r == true) {

        Swal.fire({
            title: 'Vous êtes sûr? ',
            text: "que vous voulez changer statut ?",
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
                            
                            $('.actions-success').html("<i class='fas fa-check'></i> L'action a été changer statut avec succès");
                            $('.actions-success').show();
                            setTimeout(() => {
                                $('.actions-success').hide();
                            }, 2000)
                            // $('#td'+docSelectionne).hide();
                            // setTimeout(function(){  location.reload(); }, 100);
                            getAction(pageActuel[0], pageActuel[1]);

                        }else{
                            $('.actions-errors').show();
                            setTimeout(() => {
                                $('.actions-errors').hide();
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
// --- modifier statut ----------

// --------------------- annuler --------------

$("body").on("submit", "form[name='Taction-annuler']",function(ev) {
    ev.preventDefault(); // Prevent browser default submit.

    

    // var r = confirm("Vous êtes sûr que vous voulez annuler cet action?");
    // if (r == true) {

        Swal.fire({
            title: 'Vous êtes sûr? ',
            text: "que vous voulez annuler cet action?",
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
                            
                            $('.actions-success').html("<i class='fas fa-check'></i> L'action a été annulé avec succès");
                            $('.actions-success').show();
                            setTimeout(() => {
                                $('.actions-success').hide();
                            }, 2000)
                            // $('#td'+docSelectionne).hide();
                            // setTimeout(function(){  location.reload(); }, 100);
                            getAction(pageActuel[0], pageActuel[1]);

                        }else{
                            $('.actions-errors').show();
                            setTimeout(() => {
                                $('.actions-errors').hide();
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
 
// action pagination

function getAction(page, i) {
    pageActuelAction = [page, i];
    $('.pagination_action').hide();
    $(".loader").show();
    axios.post(url_gdp+'/home?limit='+page+'&category=action&code='+coden+'&column='+column+'&order='+order)
    .then((suc) => {
        $(".TbodyAction").empty();
        $(".TbodyAction").html(suc.data);
        $(".loader").hide();
        $('.pagination_action').show();
        $('.modal').modal('hide')
    })
    .catch((err) => {
        console.log(err)
        $(".loader").hide();
        $('.pagination_action').show();
    })
}

$("body").on('click', ".Taction-th",function(){
    var th_val =$(this).text();
    var page = $('> .num-page-Action','.button__pagination__active').val();
    column = $('> .th_column',this).val();
    if($('.order_th').val()== 'desc'){  
        document.getElementById("order_th").value = "asc";
    }
    else{
        document.getElementById("order_th").value = "desc";
    }
    order =$('.order_th').val();
    $('.pagination_action').hide();
    $(".loader").show();
    // alert('order:'+order +'  thval:'+th_val+'  limit:'+ page+'  column:'+  column +'  coden:'+coden);
    axios.post(url_gdp+'/home?limit='+page+'&category=action&code='+coden+'&column='+column+'&order='+order)
    .then((suc) => {
        $(".TbodyAction").empty();
        $(".TbodyAction").html(suc.data);
        
        $(".loader").hide();
        $('.pagination_action').show();
    })
    .catch((err) => {
        console.log(err)
        $(".loader").hide();
        $('.pagination_action').show();
    })
});



