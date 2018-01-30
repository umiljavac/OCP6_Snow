$(document).ready(function () {
    $('#menu-plus').click(function () {
        if ($(this).attr("class") === "trigger-off") {
            $('.glyphicon-plus').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            $('#menu-add, #menu-user, #menu-home,#menu-edit').css("display","flex");
            $(this).removeClass("trigger-off").addClass("trigger-on");
        }
        else {
            $('#menu-add, #menu-user, #menu-home,#menu-edit').css("display", "none");
            $('.glyphicon-minus').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            $(this).removeClass("trigger-on").addClass('trigger-off');
        }
    });
});
