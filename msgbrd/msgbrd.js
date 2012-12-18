$("document").ready(function() {
    $('div.comments').hide();

    $('a.get_comments').click(function() {
        $(this).siblings('div.comments').toggle();
        return false;
    });

    $('#post_reply').bind('click', send_info_to_server);
    function send_info_to_server() {
        $('span.comment_sent').load('msgbrd/send-info-to-server.php',
                                    $('#reply').serializeArray());
    }
});
