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
    // On récupère la balise <div> en question qui contient l'attribut « data-prototype » qui nous intéresse.
    var $container = $('div#trick_videos');
    // On définit un compteur unique pour nommer les champs qu'on va ajouter dynamiquement
    var index = $container.find(':input').length;
    // On ajoute un nouveau champ à chaque clic sur le lien d'ajout.
    $('#add_video').click(function(e) {
        addVideo($container);
        e.preventDefault(); // évite qu'un # apparaisse dans l'URL
        return false;
    });
    // On ajoute un premier champ automatiquement s'il n'en existe pas déjà un (cas d'une nouvelle annonce par exemple).
    if (index === 0) {
        addVideo($container);
    } else {
        // S'il existe déjà des catégories, on ajoute un lien de suppression pour chacune d'entre elles
        $container.children('div').each(function() {
            addDeleteLink($(this));
        });
    }
    // La fonction qui ajoute un formulaire CategoryType
    function addVideo($container) {
        // Dans le contenu de l'attribut « data-prototype », on remplace :
        // - le texte "__name__label__" qu'il contient par le label du champ
        // - le texte "__name__" qu'il contient par le numéro du champ
        var template = $container.attr('data-prototype')
            .replace(/__name__label__/g, 'Vidéo n°' + (index+1))
            .replace(/__name__/g,        index)
        ;
        // On crée un objet jquery qui contient ce template
        var $prototype = $(template);
        // On ajoute au prototype un lien pour pouvoir supprimer la catégorie
        addDeleteLink($prototype);
        // On ajoute le prototype modifié à la fin de la balise <div>
        $container.append($prototype);
        // Enfin, on incrémente le compteur pour que le prochain ajout se fasse avec un autre numéro
        index++;
    }
    // La fonction qui ajoute un lien de suppression d'une catégorie
    function addDeleteLink($prototype) {
        // Création du lien
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');
        // Ajout du lien
        $prototype.append($deleteLink);
        // Ajout du listener sur le clic du lien pour effectivement supprimer la catégorie
        $deleteLink.click(function(e) {
            $prototype.remove();
            e.preventDefault(); // évite qu'un # apparaisse dans l'URL
            return false;
        });
    }
});
