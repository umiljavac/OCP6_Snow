$(document).ready(function () {
    $('.scroll-to').on('click', function() {
        var anchor = $(this).attr('href');
        console.log(anchor);
        $('html, body').animate( { scrollTop: $(anchor).offset().top }, 1000);
        return false;
    });
});

var triggers = document.getElementsByClassName('btn-trash');
var modal = document.getElementById("myModal");
var deleteLink = document.getElementById("delete-trick-modal");
var span = document.getElementsByClassName("close-span")[0];

for (var i=0; i < triggers.length; i++)
{
    triggers[i].addEventListener('click', function () {
        var id = this.getAttribute("id");
        deleteLink.setAttribute("href", "trick/" + id +"/delete");
        modal.style.display = "block";
    })
}

span.addEventListener('click', function() {
    modal.style.display = "none";
});

window.addEventListener('click', function(event) {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});

