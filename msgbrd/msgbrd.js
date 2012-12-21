$("document").ready(function() {
    $('div.foldable').hide();

    $('a.unfold').click(function() {
        $(this).siblings('div.foldable').toggle();
    });

    $('button.post').click(function () {
        $(this).parent().siblings('span.sent')
            .load('msgbrd/send-info-to-server.php',
                  $(this).parent('form').serializeArray());
    });
});
