//number of ingrédients:
ingr = 0;

//number of steps:
stp = 0;

$(document).ready(function() {

    $('.tabs').each(function(){
        $(this).find('.tab-content').hide();
        $($(this).find('ul li.active a').attr('href')).show();
        $(this).find('ul li a').click(function() {
            $(this).parents('.tabs').find('.tab-content').hide();
            $($(this).attr('href')).fadeIn(1200);
            $(this).parent().addClass('active').siblings().removeClass('active');
            return false;
        });
    });

    $('.recipes-details').each(function(){
        $(this).find('.mode-cuisine-content').hide();
        $(this).find('.mode-cuisine-button a').click(function() {
            $($(this).attr('href')).slideToggle();
            if ($(this).html() == "Cacher le mode-cuisine")
            {
                $(this).html("Afficher le mode-cuisine");
            }
            else
            {
                $(this).html("Cacher le mode-cuisine");
            }
            return false;
        });
    });

    $('.tabs-body').each(function() {
        $(this).find('.recipe-description').hide();
        $($(this).find('.recipe-img')).mouseover(function(){
            var totalHeight = $(this).height() - ($(this).height() * 0.05);
            var titleHeight = $(this).find('h5').height() + 45;
            var heightFinal = totalHeight - titleHeight;
            $(this).find('.recipe-description').attr("style", "height: " + heightFinal +"px;");
        });
        $($(this).find('.recipe-img')).mouseout(function(){
            $(this).find('.recipe-description').hide();
        });
    });

    setTimeout(function() {
        $('div.alert').fadeOut('300');
    }, 2700);


    $("ul.notes-echelle").addClass("js");
    // On passe chaque note à l'état grisé par défaut
    $("ul.notes-echelle li").addClass("note-off");
    // Au survol de chaque note à la souris
    $("ul.notes-echelle li").mouseover(function() {
        // On passe les notes supérieures à l'état inactif (par défaut)
        $(this).nextAll("li").addClass("note-off");
        // On passe les notes inférieures à l'état actif
        $(this).prevAll("li").removeClass("note-off");
        // On passe la note survolée à l'état actif (par défaut)
        $(this).removeClass("note-off");
    });
    // Lorsque l'on sort du sytème de notation à la souris
    $("ul.notes-echelle").mouseout(function() {
        // On passe toutes les notes à l'état inactif
        $(this).children("li").addClass("note-off");
        // On simule (trigger) un mouseover sur la note cochée s'il y a lieu
        $(this).find("li input:checked").parent("li").trigger("mouseover");
    });

});

function add_ingredient(ingr)
{
    var ing = document.getElementsByName("ingr["+ ingr +"]")[0].value;
    if(ing == "") {
        alert('L\'ingrédient est nul et ne peut pas rester vide !! Veuillez introduire un ingrédient');
    } else {
        ingr++;
        $('#form_ing'+ (ingr - 1)).after(
            "<div id=\"form_ing"+ ingr + "\" class=\"form-group\">" +
            "<div class='col-md-12'>" +
            "<div class='col-md-1 ing-row'>" +
            "<input name=\"quan[" + ingr + "]\" placeholder=\"Quantité\" class=\"form-control input-md\" type=\"text\">" +
            "</div>" +
            "<div style=\"padding: 0.5rem; float: left\"><p>(de)</p></div><div class=\"col-md-2\">" +
            "<input name=\"ingr[" + ingr + "]\" placeholder=\"Ingrédient\" class=\"form-control input-md\" type=\"text\" required>" +
            "</div> <div id=\"btn_ing" + ingr + "\" style=\"padding: 0.5rem; float: left\">" +
            "<a onclick=\"add_ingredient("+ ingr+")\" class=\"btn btn-sm btn-info\"><span class=\"glyphicon glyphicon-plus\" style=\"padding-bottom: 3px;\">" +
            "</span></a></div></div></div>"
        );
        $('#btn_ing' + (ingr - 1)).remove();
    }
}

function add_step(stp)
{
    var step_text = document.getElementsByName("step["+ stp +"]")[0].value;
    if(step_text == "") {
        alert('L\'étape est nul et ne peut pas rester vide !! Veuillez décrire l\'étape');
    } else {
        stp++;
        $('#form_step'+ (stp - 1)).after(
            "<div id=\"form_step"+ stp +"\" class=\"form-group\">" +
            "<label class=\"col-md-4 control-label\">Étape "+ (stp + 1) +" :</label>" +
            "<div class=\"col-md-3 steps\">" +
            "<textarea name=\"step["+ stp +"]\" placeholder=\"Entrer l'étape de la recette ...\" class=\"form-control\" required></textarea>" +
            "</div><div id=\"btn_stp"+ stp +"\" style=\"padding: 0.5rem; float: left\">" +
            "<a onclick=\"add_step("+ stp +")\" class=\"btn btn-sm btn-info\"><span class=\"glyphicon glyphicon-plus\" style=\"padding-bottom: 3px;\"></span></a>" +
            "</div></div>"
        );
        $('#btn_stp' + (stp - 1)).remove();
    }
}