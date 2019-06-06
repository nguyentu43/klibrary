$().ready(function(){

    $('.deleteFormat').click(function(e){
        if(confirm('You want to delete?'))
        {
            location.href = $(this).data('href');
        }
    });

    $('.btnDelete').click(function(e){
        e.preventDefault();
        let form = $(this).closest('form');
        if(confirm('You want to delete?'))
        {
            form.submit();
        }
    });

    $('.btnSend').click(function(e){
        $('[name="format"]').val($(this).data('format'));
    });

    $('#booksDropdown').chosen({width: '100%'});
    $('#typesDropdown').chosen({width: '100%'})

});