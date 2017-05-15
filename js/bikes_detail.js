$(function () {
    $('.rating li').mouseover(function() {
        let value = parseInt($(this).data('rating'));
        for (let i = 1; i <= value; i++) {
            $('#rating-item-' + i).find('span').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
    }).mouseout(function() {
        let value = parseInt($(this).data('rating'));
        for (let i = 1; i <= value; i++) {
            $('#rating-item-' + i).find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
    });

    $('.rating-link').click(function(e) {
        let rating = $(this).find('li').data('rating');
        $(location).attr('href',$(location).attr('href') + "?rating=" + rating);
        e.preventDefault();
        e.stopPropagation();
    });
});