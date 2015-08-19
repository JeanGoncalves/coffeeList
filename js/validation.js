$(document).ready(function() {

    $('.form').on('submit',function(e) {
        $('.validate').each(function() {
            if( $(this).val() == '' ) {
                alert($(this).data('error'));
                e.preventDefault();
                return false;
            }
        });
    });

});