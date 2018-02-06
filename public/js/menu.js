$(document).ready(function () {
    $('#menu-plus').click(function () {
        if ($(this).attr("class") === "trigger-off") {
            $('.glyphicon-plus').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            $('#menu-add,#menu-home,#menu-edit, #menu-scroll-connected').css("display","flex");
            $(this).removeClass("trigger-off").addClass("trigger-on");
        }
        else {
            $('#menu-add, #menu-home,#menu-edit, #menu-scroll-connected').css("display", "none");
            $('.glyphicon-minus').removeClass('glyphicon-minus').addClass('glyphicon-plus');
            $(this).removeClass("trigger-on").addClass('trigger-off');
        }
    });
});
