jQuery(document).ready(function ($) {

    $('#submitCarnet').click(function (e) {
        verifForm(this.form, e);
    });

    $('input').on("change paste keyup",function (e) {
        evolution(this, lastCarnet[this.name]);
    });

    function evolution(champ, value_pre) {
        var retour = '';
        if (!champ.value) {

        } else if (Number(champ.value) == Number(value_pre)) {
            retour = 'smiley-neutre';
        } else if (Number(champ.value) > Number(value_pre)) {
            retour = 'smiley-negatif';
        } else {
            retour = 'smiley-positif';
        }

        champ.onfocus = function () {
            champ.style.backgroundColor = '';
            document.getElementById('err' + champ.id).innerHTML = '';
        };
        $('#err' + champ.id).hide().removeClass().addClass('smiley ' + retour).fadeIn();
    }


    function verifForm(form, e) {
        var valide = true;

        if (form.name_contact.value == '0') {
            valide = false;
            err(form.name_contact, 'Veuillez choisir votre coach.');
        }


        if (form.poids.value == '') {
            valide = false;
            err(form.poids, 'Merci d\'indiquer votre poids atuel.');
        }


        if (form.taille.value == '') {
            valide = false;
            err(form.taille, 'Merci d\'indiquer votre taille actuelle.');

        }

        if (form.hanches.value == '') {
            valide = false;
            err(form.hanches, 'Merci d\'indiquer votre tour de hanches actuel.');
        }

        if (form.cuisse.value == '') {
            valide = false;
            err(form.cuisse, 'Merci d\'indiquer votre tour de cuisse.');
        }

        if (!valide) {
            e.preventDefault();
            goToByScroll('bilan');
        }

    }

    function err(champ, lblErr) {
        console.log(champ);
        champ.style.backgroundColor = '#FDD';
        champ.value = '';
        champ.onfocus = function () {
            this.style.backgroundColor = '';
            document.getElementById('err' + champ.id).innerHTML = '';
        };
        document.getElementById('err' + champ.id).innerHTML = lblErr;
    }

    function goToByScroll(id){
        $('html,body').animate({
                scrollTop: $("#"+id).offset().top},
            'slow');
    }

});


