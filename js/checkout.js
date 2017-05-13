$(function() {
    $('#useDlvAsInv').change(function() {
        if (!$(this).is(':checked')) {
            $('#invAddr').removeClass('hide');
        } else {
            $('#invAddr').addClass('hide');
        }
    })
});