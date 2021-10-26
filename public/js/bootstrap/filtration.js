    
    //  Get Nv from url
    // var url = window.location.href;
    // var code= url.split('/')[4];
    
    
    //filtration for document
    $('body').on('keyup','.intituleDocument, .typeDocument', function(){
        $('.container__pagination').hide();
        var intituleDocument = $(".intituleDocument").val();
        var typeDocument = $(".typeDocument").val();
        var code= $('#id-nv').val();
   
        console.log(intituleDocument.length)
        if(intituleDocument.length > 0 && typeDocument.length == 0) {
            axios.post('http://127.0.0.1:8000/filtrationDocument?intituleDocument='+intituleDocument+'&code='+code)
            .then((res) => {
                console.log(res.data)
                $(".TbodyDocument").empty();
                $(".TbodyDocument").html(res.data);
            })
            .catch((err) => {
                console.log(err)
            })
        }
        else if (intituleDocument.length == 0 && typeDocument.length > 0) {
            axios.post('http://127.0.0.1:8000/filtrationDocument?typeDocument='+typeDocument+'&code='+code)
            .then((res) => {
                console.log(res.data)
                $(".TbodyDocument").empty();
                $(".TbodyDocument").html(res.data);
            })
            .catch((err) => {
                console.log(err)
            })
        }
        else if (intituleDocument.length == 0 && typeDocument.length == 0) {
            console.log('go back the first page')
            getDocument(code,0, 1) 
            $('.container__pagination').show();
        }
        else {
            axios.post('http://127.0.0.1:8000/filtrationDocument?typeDocument='+typeDocument+'&intituleDocument='+intituleDocument+'&code='+code)
            .then((res) => {
                console.log(res.data)
                $(".TbodyDocument").empty();
                $(".TbodyDocument").html(res.data);
            })
            .catch((err) => {
                console.log(err)
            })
        }
    })
//end filtration for document
//filtration for action
    $('body').on('keyup','.intituleAction, .typeAction',function(){
        $('.container__pagination').hide();
        var intituleAction = $(".intituleAction").val();
        var typeAction = $(".typeAction").val();
        var code= $('#id-nv').val();

        console.log(intituleAction.length)
        if(intituleAction.length > 0 && typeAction.length == 0) {
            axios.post('http://127.0.0.1:8000/filtrationAction?intituleAction='+intituleAction+'&code='+code)
            .then((res) => {
                console.log(res.data)
                $(".TbodyAction").empty();
                $(".TbodyAction").html(res.data);
            })
            .catch((err) => {
                console.log(err)
            })
        }
        else if (intituleAction.length == 0 && typeAction.length > 0) {
            axios.post('http://127.0.0.1:8000/filtrationAction?typeAction='+typeAction+'&code='+code)
            .then((res) => {
                console.log(res.data)
                $(".TbodyAction").empty();
                $(".TbodyAction").html(res.data);
            })
            .catch((err) => {
                console.log(err)
            })
        }
        else if (intituleAction.length == 0 && typeAction.length == 0) {
            console.log('go back the first page')
            getAction(0, 1) 
            $('.container__pagination').show();
        }
        else {
            axios.post('http://127.0.0.1:8000/filtrationAction?typeAction='+typeAction+'&intituleAction='+intituleAction+'&code='+code)
            .then((res) => {
                console.log(res.data)
                $(".TbodyAction").empty();
                $(".TbodyAction").html(res.data);
            })
            .catch((err) => {
                console.log(err)
            })
        }
    })

 
    


 //end filtration for action