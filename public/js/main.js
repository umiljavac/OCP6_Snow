
$(document).ready(function () {
   var closeX = $('#closex');
   var clearDiv = $('.text-uppon-img');
   closeX.click(function () {
       clearDiv.remove();
   });
        centerBlocks();

        $(window).resize(function() {
            centerBlocks();
        });
});

function centerBlocks() {

    var imgBlocks = $('.img-slot');
    var imgBlocksNb = imgBlocks.length;
    var imgBlockW = parseFloat(window.getComputedStyle(imgBlocks[0],null).getPropertyValue('width'));
    var imgBlocksByRow;
    var marginMin = 15;

    var winW = window.innerWidth;
    var divFlexW = winW - 20;

    imgBlocksByRow = Math.floor(divFlexW / (imgBlockW + marginMin));
    if (imgBlocksByRow > imgBlocksNb) {
        imgBlocksByRow = imgBlocksNb;
    }
    var marginDisp = divFlexW - ( imgBlocksByRow * imgBlockW);
    var marginBlock = marginDisp / imgBlocksByRow;
    var centerBlock = marginDisp / (imgBlocksByRow + 1);

    for (var i = 0; i < imgBlocksNb; i++) {
        imgBlocks[i].style.marginLeft = String(centerBlock) + 'px';
    }
}
