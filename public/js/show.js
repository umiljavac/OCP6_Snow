var imageZoom = 0;
$(document).ready(function () {
    $('.image').click(function () {
        imageZoom = 1;
        var imgClone = $(this).clone();
        $(".flex-div").hide();
        imgClone.addClass("image-full");
        var zoomDiv = $("<div class='zoom-div'></div>");
        zoomDiv.append(imgClone);
        $('#trick-title').append(zoomDiv);

        $(imgClone).click(function () {
            imageZoom = 0;
            zoomDiv.remove();
            $(".flex-div").show();
            centerBlocks();
        });
    });

    checkSize();
    $(window).resize(function() {

        checkSize();
    });

    function checkSize() {
        var medias = $('#flex-show');
        var openMedias = $('#view-media');
        var winW = window.innerWidth;

        if (winW < 460) {
            if (imageZoom === 0) {
                medias.css('display', 'none');
                openMedias.css('display', 'flex');
                openMedias.on('click', function () {
                    $(this).hide();
                    medias.css('display', 'flex');
                    centerBlocks();
                })
            }
        } else {
            openMedias.css('display', 'none');
            if (imageZoom === 0) {
                medias.css('display', 'flex');
            } else {
                medias.css('display', 'none');
            }
        }
    }

    var letters = $('.trick-name h1').text();
    console.log(letters);
});
