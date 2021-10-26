
$('body').on('click', '.button__pagination', function() {
    $('#container__pagination .button__pagination').removeClass('button__pagination__active')
    $(this).addClass('button__pagination__active')
})
$('body').on('click', '.button__pagination', function() {
    $('#container__paginationAction .button__pagination').removeClass('button__pagination__active')
    $(this).addClass('button__pagination__active')
})

$('body').on('click', '.plus', function() {  
    if($(this).hasClass('active__plus')) {
        $(this).removeClass('active__plus');
    } else {
        $(this).addClass('active__plus');
    }
    if($('> .fas',this).hasClass('fa-folder')) {
        $('> .fas',this).removeClass("fa-folder").addClass("fa-folder-open");        
    } 
    else if($('> .fas',this).hasClass('fa-folder-open')) {
        $('> .fas',this).removeClass("fa-folder-open").addClass("fa-folder");  
    }
    else if($('> .fas',this).hasClass('fa-file')) {
        $('> .fas',this).removeClass("fa-file").addClass("fa fa-files-o");  
    }
    else if($('> .fas',this).hasClass('fa-files-o')) {
        $('> .fas',this).removeClass("fa fa-files-o").addClass("fa-file");  
    }

});
$('.buttonFinal').click("#last__page", function() {
    $(".pagination").animate( { scrollLeft: '+=3000' }, 100);
})
$('.buttonDebut').click("#fisrt__page", function() {
    $(".pagination").animate( { scrollLeft: '-=3000' }, 100);
})

var slideLeft = $("#fa-chevron-left");
var slideRight = $("#fa-chevron-right");
var slideLeftAction = $("#fa-chevron-leftAction");
var slideRightAction = $("#fa-chevron-rightAction");

slideLeft.click(function() {
    $(".pagination").animate( { scrollLeft: '-=110' }, 100);
})
slideRight.click(function() {
    $(".pagination").animate( { scrollLeft: '+=110' }, 100);
})
slideLeftAction.click(function() {
    $(".pagination").animate( { scrollLeft: '-=110' }, 100);
})
slideRightAction.click(function() {
    $(".pagination").animate( { scrollLeft: '+=110' }, 100);
})

$('body').on('click', '.colu', function() {
    $('#table-data .i_th').removeClass('fa fa-sort')
    $(this).find('.i_th').addClass('fa fa-sort')
})


    




    
