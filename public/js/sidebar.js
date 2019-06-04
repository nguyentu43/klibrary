$(document).ready(function(){
    $('#sidebar .nav-item button').click(function(event){
        event.stopPropagation();
        location = $(this).data('href');
        return false;
    })
});