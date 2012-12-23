$("document").ready(function() {
    $("button").click(function () {
        $("#response").load("modify.php",
                            $("#modify").serializeArray());
    });
});
