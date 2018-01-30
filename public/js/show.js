$(document).ready(function () {
    $('.image').click(function () {
        var imgClone = $(this).clone();
        $(".flex-div").hide();
        imgClone.addClass("image-full");
        var zoomDiv = $("<div class='zoom-div'></div>");
        zoomDiv.append(imgClone);
        $('#trick-title').append(zoomDiv);

        $(imgClone).click(function () {
            zoomDiv.remove();
            $(".flex-div").show();
            centerBlocks();
        });
    });
});

