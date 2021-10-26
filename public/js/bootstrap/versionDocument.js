// --------------------- Supprimer --------------

$("body").on("submit", "form[name='TdocumentVersion-suspendre']", function(ev) {
    ev.preventDefault(); // Prevent browser default submit.
    
    // var r = confirm("Vous êtes sûr que vous voulez Supprimer ce document?");
    // if (r == true) {
        Swal.fire({
            title: 'Vous êtes sûr? ',
            text: "que vous voulez Supprimer cet version?",
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
                            $('.docoments-success').html('<i class="fas fa-check"></i> La version a été Supprimé avec succès');
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
