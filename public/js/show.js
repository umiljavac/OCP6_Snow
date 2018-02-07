var imageZoom = 0;
$(document).ready(function () {
    $('.image').click(function (e) {
        imageZoom = 1;
        var imgClone = $(this).clone();
        $(".flex-div").hide();
        imgClone.addClass("image-full");
        var zoomDiv = $("<div class='zoom-div'></div>");
        zoomDiv.append(imgClone);
        $('#trick-title').append(zoomDiv);

        $(imgClone).click(function (e) {
            imageZoom = 0;
            zoomDiv.remove();
            $(".flex-div").show();
            centerBlocks();
            e.preventDefault();
        });
        e.preventDefault()
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

    var nbCom = 5;
    var limit = 0;
    var offset = 5;

    showComment();


    $('#loadMore').click(function (e) {
        limit = offset;
        offset = offset + nbCom;
        showComment();

        if ($('.comment-div:hidden').length === 0)
        {
            $(this).hide();
        }
        e.preventDefault();
    });

    function showComment() {
        $('.comment-div').slice(limit, offset).show();
    }
});
