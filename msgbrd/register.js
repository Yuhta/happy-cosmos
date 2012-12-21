$("document").ready(function() {
    $("button").click(function () {
        $("#response").load("usr-register.php",
                            $("#register").serializeArray());
    });
});
