$(document).ready(function() {
    $(document).on('click','.clear',function(e) {
        e.preventDefault()
        $('form input').val('');
        $(this).closest('form').find('.row input:first').focus();
    });
});