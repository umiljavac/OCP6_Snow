$(document).ready(function() {
    var $container = $('div#trick_images');
    var indexI = $container.find(':input').length;

    $('#add_image').click(function(e) {
        addImage($container);
        e.preventDefault();
        return false;
    });
    if (indexI === 0) {
        addImage($container);
    } else {
        $container.children('div').each(function() {
            addDeleteLink($(this));
        });
    }
    function addImage($container) {
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Image n°' + (indexI+1))
            .replace(/__name__/g,        indexI)
        ;
        var $prototype = $(template);
        addDeleteLink($prototype);
        $container.append($prototype);
        indexI++;

    }
    function addDeleteLink($prototype) {
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        $prototype.append($deleteLink);
        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault();
            return false;
        });
    }
});
$(document).ready(function() {
    var $container = $('div#trick_videos');
    var index = $container.find(':input').length;
    $('#add_video').click(function(e) {
        addVideo($container);
        e.preventDefault();
        return false;
    });
    if (index === 0) {
        addVideo($container);
    } else {
        $container.children('div').each(function() {
            addDeleteLink($(this));
        });
    }
    function addVideo($container) {
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Vidéo n°' + (index+1))
            .replace(/__name__/g,        index)
        ;
        var $prototype = $(template);
        addDeleteLink($prototype);
        $container.append($prototype);
        index++;
    }
    function addDeleteLink($prototype) {
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        $prototype.append($deleteLink);
        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault();
            return false;
        });
    }
});

$(document).ready(function() {
    var imgs = $('.img-form');
    var counter = imgs.length;
    for (var i = 0; i < imgs.length; i++)
    {
       var formElement = $('#trick_images_'+ i + '_file');
       formElement.after(imgs[i]);
       formElement.hide();

       var divElement = $('#trick_images_' + i);
       divElement.find('label').hide();
       divElement.prev().text('Image n° ' + (i + 1));
    }

    $("label[for='trick_images_0_file']").hide();
    var add = $('#add_image');
    add.click(function () {
        $('#trick_images_' + counter +'_file').prev().hide();
        var $container = $('div#trick_images');
        var indexI = $container.find('input').length;
        for (var i = 0; i <= indexI; i++ )
        {
            $("label[for='trick_images_" + i + "_file']").hide();
        }
        counter++;
    })
});

$(document).ready(function() {
    var videos = $('#trick_videos');
    nbVideos = videos.find('input').length;
    var counter = nbVideos;

    for (var i = 0; i < nbVideos; i++)
    {
        var divElement = $('#trick_videos_' + i);
        divElement.find('label').hide();
        divElement.prev().text('Video n° ' + (i + 1));
    }

    var add = $('#add_video');
    add.click(function () {
        $('#trick_videos_' + counter +'_link').prev().hide();
        counter++;
    });

    var videoThumb = $('.video-thumb');
    for (var x = 0; x < videoThumb.length; x++)
    {
        var imgThumb = $(videoThumb[x]).find('img');
        var linkVideo = imgThumb.attr("src");
        var linkThumb = replaceLink(linkVideo);
        imgThumb.attr("src", linkThumb);
        var formElt = $('#trick_videos_' + x);
        formElt.after(videoThumb[x]);
    }

    function replaceLink(link) {
        var re = new RegExp("youtube");
        var re1 = new RegExp("dailymotion");
        if (re.test(link) === true)
        {
            /\/embed\/([-a-zA-Z0-9_]+)/.exec(link);
            var linkEltY = RegExp.$1;
            return "https://img.youtube.com/vi/" + linkEltY + "/hqdefault.jpg"

        }
        if (re1.test(link) === true)
        {
            /\/video\/([-a-zA-Z0-9_]+)/.exec(link);
            var linkEltD = RegExp.$1;
            return "https://www.dailymotion.com/thumbnail/video/" + linkEltD;
        }
    }
});
