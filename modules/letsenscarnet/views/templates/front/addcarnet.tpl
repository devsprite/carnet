{capture name=path}{l s='Mon carnet' mod='letsenscarnet'}{/capture}

{if $confirmation}
    <p class="alert alert-success">{$confirmation}</p>
<p>{$mails['{nom}']}</p>
<p>{$mails['{poids_actuel}']}</p>
<p>{$mails['{message_poids}']}</p>
<p>{$mails['{message_taille}']}</p>
<p>{$mails['{message_hanches}']}</p>
<p>{$mails['{message_cuisse}']}</p>
<p>{$mails['{message_sante}']}</p>
<p>{$mails['{message_activite_physique}']}</p>
<p>{$mails['{message_alimentation_suivi}']}</p>
<p>{$mails['{message_alimentation_complements_alimentaires}']}</p>
<p>{$mails['{message_alimentation_eau_par_jour}']}</p>
<p>{$mails['{message_alimentation_mange_entre_repas}']}</p>
<p>{$mails['{message_alimentation_repas_particulier}']}</p>
<p>{$mails['{message_alimentation_alimentation_plaisir}']}</p>
<p>{$mails['{message_programme_satisfaction_resultat}']}</p>
<p>{$mails['{message_programme_resolution}']}</p>
<p>{$mails['{message_motivation}']}</p>

{else}
{if $last_carnet}{addJsDef lastCarnet=$last_carnet}{/if}
{include file="$tpl_dir./errors.tpl"}
    <h2>VOTRE CARNET D'AUTO-SUIVI</h2>
    <h3>A quoi ça sert ?</h3>
    <p>A compléter chaque semaine, ce formulaire vous permet de faire vous-même un bilan régulier de vos résultats et de
        votre façon de gérer votre programme minceur.
    </p>
    <h3>Comment ça marche?</h3>
    <p>Trois types de repères sont utilisés dans ce formulaire afin de vous guider dans l'interprétation de vos réponses
        :</p>
    <ul>
        <li><i class="smiley smiley-positif"></i> Points positifs, vous pouvez continuer comme ça!</li>
        <li><i class="smiley smiley-neutre"></i> Points à surveiller : Vous devrez être vigilant(e) sur ces points à partir d'aujourd'hui si vous voulez
            obtenir des résultats satisfaisants.
        </li>
        <li><i class="smiley smiley-negatif"></i> Points d'alerte : Ils nécessitent une réaction rapide de votre part. Nous vous conseillons de prendre contact
            avec votre coach (par mail ou par téléphone) pour aborder ces points et trouver des solutions.
        </li>
    </ul>
    <p>Une fois votre bilan validé, vous recevrez un e-mail contenant un récapitulatif de vos réponses. Retrouvez ces
        informations dans voter compte</p>
    <p></p>
    <h2 id="bilan">Bilan de la semaine</h2>

    <form id="form_carnet" action="" method="POST" class="default-form form-horizontal box">
        <div class="form-group">
            <label for="name_contact" class="col-xs-4 {if isset($errors['contact'])}{$errors['contact']}{/if}" >Votre coach</label>
            <div class="col-xs-4">
                <select id="name_contact" class="form-control" name="name_contact" class="col-xs-3">
                    <option value="0">{l s='-- Choisissez --'}</option>
                    {foreach from=$name_contacts item=contact}
                        <option value="{$contact['id_contact']}"{if isset($smarty.post.name_contact) && $smarty.post.name_contact == $contact['id_contact']} selected="selected"{/if}>{$contact['name']|escape:'html':'UTF-8'}</option>
                    {/foreach}
                </select>
            </div>
            <span id="errname_contact" class=""></span>
        </div>

        <div class="form-group">
            <p class="col-xs-4">Date du bilan :</p>
            <div class="col-xs-8"> {$smarty.now|date_format:'%d-%m-%Y'}
                <input type="hidden" name="date_form" value="{$smarty.now|date_format:'%Y-%m-%d'}">
            </div>
        </div>
        <!-- Mensuration - Poids -->
        <div class="form-group">
            <p class="page-subheading">
                Mensuration - Poids
            </p>
        </div>
        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['poids'])}{$errors['poids']}{/if}" for="poids">Aujourd'hui, quel
                est votre poids (en kg) ?</label>
            <div class="col-xs-8">
                <input type="number" id="poids" name="poids" step="any" placeholder="kg"
                       value="{if isset($smarty.post.poids)}{$smarty.post.poids|escape:'htmlall':'utf-8'}{/if}">
                <span id="errpoids" class=""></span>
            </div>
        </div>

        <!-- Mensuration - Taille  -->
        <div class="form-group">
            <p class="page-subheading">
                Mensuration - Tour de taille
            </p>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['taille'])}{$errors['taille']}{/if}" for="taille">Aujourd'hui, quel
                est votre tour de taille (en cm) ?</label>
            <div class="col-xs-8">
                <input type="number" id="taille" name="taille" placeholder="cm"
                       value="{if isset($smarty.post.taille)}{$smarty.post.taille|escape:'htmlall':'utf-8'}{/if}">
                <span id="errtaille" class=""></span>
            </div>
        </div>

        <!-- Mensuration - Tour de hanches  -->
        <div class="form-group">
            <p class="page-subheading">
                Mensuration - Tour de hanches
            </p>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['hanches'])}{$errors['hanches']}{/if}" for="hanches">Aujourd'hui,
                quel est votre tour de hanches (en cm) ?</label>
            <div class="col-xs-8">
                <input type="number" id="hanches" name="hanches" placeholder="cm"
                       value="{if isset($smarty.post.hanches)}{$smarty.post.hanches|escape:'htmlall':'utf-8'}{/if}">
                <span id="errhanches" class="smiley"></span>
            </div>
        </div>

        <!-- Mensuration - Tour de cuisse  -->
        <div class="form-group">
            <p class="page-subheading">
                Mensuration - Tour de cuisse
            </p>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['cuisse'])}{$errors['cuisse']}{/if}" for="cuisse">Aujourd'hui, quel
                est votre tour de cuisse (en cm) ?</label>
            <div class="col-xs-8">
                <input type="number" id="cuisse" name="cuisse" placeholder="cm"
                       value="{if isset($smarty.post.cuisse)}{$smarty.post.cuisse|escape:'htmlall':'utf-8'}{/if}">
                <span id="errcuisse" class=""></span>
            </div>
        </div>

        <!-- Santé  -->
        <div class="form-group">
            <p class="page-subheading">
                Santé
            </p>
        </div>

        <div class="form-group">
            <div class="col-xs-4 {if isset($errors['sante'])}{$errors['sante']}{/if}">
                <label for="inputs_sante">Durant la semaine écoulée...</label>
            </div>
            <div class="col-xs-8">
                {foreach item=input_sante from=$inputs_sante}
                <label>
                    <input id="inputs_sante" name="inputs_sante[]" type="checkbox" value="{$input_sante[0]}">
                    {$input_sante[1]}
                </label><br>
                {/foreach}
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['sante_autre'])}{$errors['sante_autre']}{/if}" for="sante_autre">Autre</label>
            <div class="col-xs-8">
                <input id="sante_autre" name="sante_autre" type="text"
                       value="{if isset($smarty.post.sante_autre)}{$smarty.post.sante_autre|escape:'htmlall':'utf-8'}{/if}">
            </div>
        </div>

        <!-- Activité physique  -->
        <div class="form-group">
            <p class="page-subheading">
                Activité physique
            </p>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['activite_physique'])}{$errors['activite_physique']}{/if}"
                   for="activite_physique_1">Durant la semaine écoulée, avez-vous pratiqué une
                activité
                sportive ?</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="activite_physique_1" name="activite_physique"
                               value="Oui_comme_a_votre_habitude"  {if isset($smarty.post.activite_physique) && $smarty.post.activite_physique =="Oui_comme_a_votre_habitude"}checked{/if}><label
                                class="smileMoins" for="activite_physique_1">Oui, comme à votre habitude</label>
                    </li>
                    <li><input type="radio" id="activite_physique_2" name="activite_physique"
                               value="Oui_vous_avez_fait_l_effort" {if isset($smarty.post.activite_physique) && $smarty.post.activite_physique =="Oui_vous_avez_fait_l_effort"}checked{/if}><label
                                class="smileEgal" for="activite_physique_2">Oui, vous avez fait l'effort</label>
                    </li>
                    <li><input type="radio" id="activite_physique_3" name="activite_physique"
                               value="Pas_vraiment_mais_c_est_en_projet" {if isset($smarty.post.activite_physique) && $smarty.post.activite_physique =="Pas_vraiment_mais_c_est_en_projet"}checked{/if}><label
                                class="smilePlus" for="activite_physique_3">Pas vraiment, mais c'est en projet</label>
                    </li>
                    <li><input type="radio" id="activite_physique_4" name="activite_physique"
                               value="Non_vous_etes_définitivement_faché(e)" {if isset($smarty.post.activite_physique) && $smarty.post.activite_physique =="Non_vous_etes_définitivement_faché(e)"}checked{/if}><label
                            class="smilePlus" for="activite_physique_4">Non, vous êtes définitivement faché(e) avec le sport</label>
                    </li>
                    <li><input type="radio" id="activite_physique_5" name="activite_physique"
                               value="Non_vous_ne_pouvez_pas_pratiquer_d_activité_sportive" {if isset($smarty.post.activite_physique) && $smarty.post.activite_physique =="Non_vous_ne_pouvez_pas_pratiquer_d_activité_sportive"}checked{/if}><label
                            class="smilePlus" for="activite_physique_5">Non, vous ne pouvez pas pratiquer d'activité sportive </label>
                    </li>
                </ul>
            </div>
            <label for="activite_physique_heure"
                   class="col-xs-4  {if isset($errors['activite_physique_heure'])}{$errors['activite_physique_heure']}{/if}">Si
                oui, combien d'heures dans la semaine (en tout)
                ?</label>
            <div class="col-xs-8">
                <input type="time" id="activite_physique_heure" name="activite_physique_heure"
                       value="{if isset($smarty.post.activite_physique_heure)}{$smarty.post.activite_physique_heure|escape:'htmlall':'utf-8'}{/if}">
            </div>
        </div>


        <!-- Alimentation  -->
        <div class="form-group">
            <p class="page-subheading">
                Alimentation
            </p>
        </div>
        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_faim'])}{$errors['alimentation_faim']}{/if}"
                   for="alimentation_faim_1">Avez-vous eu faim ?</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="alimentation_faim_1"
                               name="alimentation_faim"
                               value="Oui"  {if isset($smarty.post.alimentation_faim) && $smarty.post.alimentation_faim =="Oui"}checked{/if}><label
                            class="smileMoins" for="alimentation_faim_1"> Oui</label></li>
                    <li><input type="radio" id="alimentation_faim_2"
                               name="alimentation_faim"
                               value="Non" {if isset($smarty.post.alimentation_faim) && $smarty.post.alimentation_faim =="Non"}checked{/if}><label
                            class="smileEgal" for="alimentation_faim_2"> Non</label></li>
                </ul>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_suivi'])}{$errors['alimentation_suivi']}{/if}"
                   for="alimentation_suivi_1">Cette semaine, avez-vous bien suivi la méthode
                diététique
                Ligne&Sens ?</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="alimentation_suivi_1" name="alimentation_suivi"
                               value="Oui"  {if isset($smarty.post.alimentation_suivi) && $smarty.post.alimentation_suivi =="Oui"}checked{/if}><label
                                class="smileMoins" for="alimentation_suivi_1"> Oui</label></li>
                    <li><input type="radio" id="alimentation_suivi_2" name="alimentation_suivi"
                               value="J_essai_mais_difficile" {if isset($smarty.post.alimentation_suivi) && $smarty.post.alimentation_suivi =="J_essai_mais_difficile"}checked{/if}><label
                                class="smileEgal" for="alimentation_suivi_2"> J'essaie, mais c'est parfois difficile</label></li>
                    <li><input type="radio" id="alimentation_suivi_3" name="alimentation_suivi"
                               value="Non" {if isset($smarty.post.alimentation_suivi) && $smarty.post.alimentation_suivi =="Non"}checked{/if}><label
                                class="smilePlus" for="alimentation_suivi_3"> Non, je n'ai pas l'intention de la suivre</label>
                    </li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_complements_alimentaires'])}{$errors['alimentation_complements_alimentaires']}{/if}"
                   for="alimentation_complements_alimentaires_1">Avez-vous pris vos compléments
                alimentaires L&Sens régulièrement ?</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="alimentation_complements_alimentaires_1"
                               name="alimentation_complements_alimentaires"
                               value="Oui"  {if isset($smarty.post.alimentation_complements_alimentaires) && $smarty.post.alimentation_complements_alimentaires =="Oui"}checked{/if}><label
                                class="smileMoins" for="alimentation_complements_alimentaires_1"> Oui</label></li>
                    <li><input type="radio" id="alimentation_complements_alimentaires_2"
                               name="alimentation_complements_alimentaires"
                               value="Non" {if isset($smarty.post.alimentation_complements_alimentaires) && $smarty.post.alimentation_complements_alimentaires =="Non"}checked{/if}><label
                                class="smileEgal" for="alimentation_complements_alimentaires_2"> Non</label></li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_eau_par_jour'])}{$errors['alimentation_eau_par_jour']}{/if}"
                   for="alimentation_eau_par_jour_1">Avez-vous bu 1,5 litre d'eau par jour ?</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="alimentation_eau_par_jour_1" name="alimentation_eau_par_jour"
                               value="Oui"  {if isset($smarty.post.alimentation_eau_par_jour) && $smarty.post.alimentation_eau_par_jour =="Oui"}checked{/if}><label
                                class="smileMoins" for="alimentation_eau_par_jour_1"> Oui</label></li>
                    <li><input type="radio" id="alimentation_eau_par_jour_2" name="alimentation_eau_par_jour"
                               value="Non" {if isset($smarty.post.alimentation_eau_par_jour) && $smarty.post.alimentation_eau_par_jour =="Non"}checked{/if}><label
                                class="smileEgal" for="alimentation_eau_par_jour_2"> Non</label></li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_mange_entre_repas'])}{$errors['alimentation_mange_entre_repas']}{/if}"
                   for="alimentation_mange_entre_repas_1">Avez-vous mangé entre les repas ?</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="alimentation_mange_entre_repas_1"
                               name="alimentation_mange_entre_repas"
                               value="Non"  {if isset($smarty.post.alimentation_mange_entre_repas) && $smarty.post.alimentation_mange_entre_repas =="Non"}checked{/if}><label
                                class="smileMoins" for="alimentation_mange_entre_repas_1"> Non, jamais</label></li>
                    <li><input type="radio" id="alimentation_mange_entre_repas_2"
                               name="alimentation_mange_entre_repas"
                               value="Oui_collation" {if isset($smarty.post.alimentation_mange_entre_repas) && $smarty.post.alimentation_mange_entre_repas =="Oui_collation"}checked{/if}><label
                                class="smileEgal" for="alimentation_mange_entre_repas_2"> Oui, vous avez eu faim et pris
                                des collations (en milieu de matinée ou milieu d'après-midi)</label></li>
                    <li><input type="radio" id="alimentation_mange_entre_repas_3"
                               name="alimentation_mange_entre_repas"
                               value="Oui_grignote" {if isset($smarty.post.alimentation_mange_entre_repas) && $smarty.post.alimentation_mange_entre_repas =="Oui_grignote"}checked{/if}><label
                                class="smileEgal" for="alimentation_mange_entre_repas_3"> Oui, vous avez grignoté
                            par-ci par-là (hors collations)</label></li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_repas_particulier'])}{$errors['alimentation_repas_particulier']}{/if}"
                   for="alimentation_repas_particulier_1">Avez-vous pris un ou plusieurs repas dans
                des situations particulières ? (Restaurant, repas de fête, invitation...)</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="alimentation_repas_particulier_2"
                               name="alimentation_repas_particulier"
                               value="Oui"  {if isset($smarty.post.alimentation_repas_particulier) && $smarty.post.alimentation_repas_particulier =="Oui"}checked{/if}><label
                                class="" for="alimentation_repas_particulier_2"> Oui</label></li>
                    <li><input type="radio" id="alimentation_repas_particulier_1"
                               name="alimentation_repas_particulier"
                               value="Non" {if isset($smarty.post.alimentation_repas_particulier) && $smarty.post.alimentation_repas_particulier =="Non"}checked{/if}><label
                                class="" for="alimentation_repas_particulier_1"> Non</label></li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_respect_methode'])}{$errors['alimentation_respect_methode']}{/if}"
                   for="alimentation_respect_methode_1">Si oui, avez-vous tout de même respecté la
                méthode diététique ces jours-là ?</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="alimentation_respect_methode_1"
                               name="alimentation_respect_methode"
                               value="Oui"  {if isset($smarty.post.alimentation_respect_methode) && $smarty.post.alimentation_respect_methode =="Oui"}checked{/if}><label
                                class="smileMoins" for="alimentation_respect_methode_1"> Oui</label></li>
                    <li><input type="radio" id="alimentation_respect_methode_2"
                               name="alimentation_respect_methode"
                               value="Non" {if isset($smarty.post.alimentation_respect_methode) && $smarty.post.alimentation_respect_methode =="Non"}checked{/if}><label
                                class="smileEgal" for="alimentation_respect_methode_2"> Non</label></li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_plaisir'])}{$errors['alimentation_plaisir']}{/if}"
                   for="alimentation_plaisir">Au niveau alimentaire cette semaine, quelles ont été
                vos sources de plaisir ?</label>
            <div class="col-xs-8">
            <textarea type="text" cols="40" rows="5" id="alimentation_plaisir"
                      name="alimentation_plaisir"
            >{if isset($smarty.post.alimentation_plaisir)}{$smarty.post.alimentation_plaisir|escape:'htmlall':'utf-8'}{/if}</textarea>

            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['alimentation_frustration'])}{$errors['alimentation_frustration']}{/if}"
                   for="alimentation_frustration">Au niveau alimentaire cette semaine, quelles ont
                été vos sources de frustration ?</label>
            <div class="col-xs-8">
            <textarea type="text" cols="40" rows="5" id="alimentation_frustration"
                      name="alimentation_frustration"
            >{if isset($smarty.post.alimentation_frustration)}{$smarty.post.alimentation_frustration|escape:'htmlall':'utf-8'}{/if}</textarea>
                <p>Si votre sentiment de frustration est inférieur à votre sentiment de plaisir =</p>
                <p>Si votre sentiment de frustration est égal à votre sentiment de plaisir =</p>
                <p>Si votre sentiment de frustration est supérieur à votre sentiment de plaisir = </p>

            </div>
        </div>

        <div class="form-group">
            <label for="alimentation_faim_autre" class="col-xs-4">Autre</label>
            <div class="col-xs-8">
                <input type="text" id="alimentation_faim_autre"
                       name="alimentation_faim_autre"
                       value="{if isset($smarty.post.alimentation_faim_autre)}{$smarty.post.alimentation_faim_autre|escape:'htmlall':'utf-8'}{/if}">
            </div>
        </div>

        <!-- Votre programme et vous  -->
        <div class="form-group">
            <p class="page-subheading">
                Votre programme et vous - Satisfaction
            </p>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['programme_satisfaction_resultat'])}{$errors['programme_satisfaction_resultat']}{/if}"
                   for="programme_satisfaction_resultat_5">Aujourd'hui, quel est votre degré de
                satisfaction à l'égard de vos résultats ?</label>
            <div class="col-xs-8">
                <p>Evaluez votre satisfaction en donnant une note entre 0 (pas satisfait(e) du tout) et 10 (pleinement
                    satisfait(e))
                    Satisfaction : de 10 à 7 = - de 6 à 4 = - de 3 à 0 = </p>
                <label class="smileMoins radio-inline" for="programme_satisfaction_resultat_0">
                    <input type="radio" id="programme_satisfaction_resultat_0" name="programme_satisfaction_resultat"
                           value="0"  {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="0"}checked{/if}>&nbsp;0</label>
                <label class="smileMoins radio-inline" for="programme_satisfaction_resultat_1">
                    <input type="radio" id="programme_satisfaction_resultat_1" name="programme_satisfaction_resultat"
                           value="1" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="1"}checked{/if}>&nbsp;1</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_2">
                    <input type="radio" id="programme_satisfaction_resultat_2" name="programme_satisfaction_resultat"
                           value="2" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="2"}checked{/if}>&nbsp;2</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_3">
                    <input type="radio" id="programme_satisfaction_resultat_3" name="programme_satisfaction_resultat"
                           value="3" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="3"}checked{/if}>&nbsp;3</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_4">
                    <input type="radio" id="programme_satisfaction_resultat_4" name="programme_satisfaction_resultat"
                           value="4" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="4"}checked{/if}>&nbsp;4</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_5">
                    <input type="radio" id="programme_satisfaction_resultat_5" name="programme_satisfaction_resultat"
                           value="5" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="5"}checked{/if}>&nbsp;5</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_6">
                    <input type="radio" id="programme_satisfaction_resultat_6" name="programme_satisfaction_resultat"
                           value="6" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="6"}checked{/if}>&nbsp;6</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_7">
                    <input type="radio" id="programme_satisfaction_resultat_7" name="programme_satisfaction_resultat"
                           value="7" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="7"}checked{/if}>&nbsp;7</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_8">
                    <input type="radio" id="programme_satisfaction_resultat_8" name="programme_satisfaction_resultat"
                           value="8" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="8"}checked{/if}>&nbsp;8</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_9">
                    <input type="radio" id="programme_satisfaction_resultat_9" name="programme_satisfaction_resultat"
                           value="9" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="9"}checked{/if}>&nbsp;9</label>
                <label class="smileEgal radio-inline" for="programme_satisfaction_resultat_10">
                    <input type="radio" id="programme_satisfaction_resultat_10" name="programme_satisfaction_resultat"
                           value="10" {if isset($smarty.post.programme_satisfaction_resultat) && $smarty.post.programme_satisfaction_resultat =="10"}checked{/if}>&nbsp;10</label>
            </div>
        </div>

        <br>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['programme_satisfaction_semaine'])}{$errors['programme_satisfaction_semaine']}{/if}"
                   for="programme_satisfaction_semaine_1">Etes-vous satisfait(e) de ce que VOUS avez
                accompli cette semaine ?</label>
            <p>Au delà des résultats, vous jugez ici vos efforts personnels et l'accomplissement des résolutions prises
                lors de votre précédent bilan ou au commencement de votre programme.</p>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="programme_satisfaction_semaine_1"
                               name="programme_satisfaction_semaine"
                               value="Oui"  {if isset($smarty.post.programme_satisfaction_semaine) && $smarty.post.programme_satisfaction_semaine =="Oui"}checked{/if}><label
                                class="smileMoins" for="programme_satisfaction_semaine_1"> Oui</label></li>
                    <li><input type="radio" id="programme_satisfaction_semaine_2"
                               name="programme_satisfaction_semaine"
                               value="Non" {if isset($smarty.post.programme_satisfaction_semaine) && $smarty.post.programme_satisfaction_semaine =="Non"}checked{/if}><label
                                class="smileEgal" for="programme_satisfaction_semaine_2"> Non</label></li>
                </ul>
            </div>
            <label for="programme_satisfaction_semaine_autre" class="col-xs-4 {if isset($errors['programme_satisfaction_semaine_autre'])}{$errors['programme_satisfaction_semaine_autre']}{/if}">Autre</label>
            <div class="col-xs-8">
                <input type="text" id="programme_satisfaction_semaine_autre"
                       name="programme_satisfaction_semaine_autre"
                       value="{if isset($smarty.post.programme_satisfaction_semaine_autre)}{$smarty.post.programme_satisfaction_semaine_autre|escape:'htmlall':'utf-8'}{/if}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['programme_resolution'])}{$errors['programme_resolution']}{/if}"
                   for="programme_resolution">Notez ici une résolution que vous décidez de mettre en oeuvre
                dans la semaine qui vient :</label>
            <div class="col-xs-8">
                <p>Votre objectif prioritaire pour la semaine à venir sera d'appliquer cette résolution.</p>
                <textarea type="text" cols="40" rows="5" id="programme_resolution"
                          name="programme_resolution">{if isset($smarty.post.programme_resolution)}{$smarty.post.programme_resolution|escape:'htmlall':'utf-8'}{/if}</textarea>
            </div>
        </div>

        <!-- Motivation  -->
        <div class="form-group">
            <p class="page-subheading">
                Votre programme et vous - Motivation
            </p>
        </div>

        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['motivation'])}{$errors['motivation']}{/if}" for="motivation_5">Aujourd'hui,
                comment évaluez-vous votre motivation
                ?</label>
            <div class="col-xs-8">
                <p>Donnez une note entre 0 (pas motivé(e) du tout) et 10 (motivé(e) à 100%)
                    Motivation : de 10 à 7 = - de 6 à 4 = - de 3 à 0 = </p>
                <label class="smileMoins radio-inline" for="motivation_0">
                    <input type="radio" id="motivation_0" name="motivation"
                           value="0"   {if isset($smarty.post.motivation) && $smarty.post.motivation =="0"}checked{/if}>&nbsp;0</label>
                <label class="smileMoins radio-inline" for="motivation_1">
                    <input type="radio" id="motivation_1" name="motivation"
                           value="1" {if isset($smarty.post.motivation) && $smarty.post.motivation =="1"}checked{/if}>&nbsp;1</label>
                <label class="smileEgal radio-inline" for="motivation_2">
                    <input type="radio" id="motivation_2" name="motivation"
                           value="2" {if isset($smarty.post.motivation) && $smarty.post.motivation =="2"}checked{/if}>&nbsp;2</label>
                <label class="smileEgal radio-inline" for="motivation_3">
                    <input type="radio" id="motivation_3" name="motivation"
                           value="3" {if isset($smarty.post.motivation) && $smarty.post.motivation =="3"}checked{/if}>&nbsp;3</label>
                <label class="smileEgal radio-inline" for="motivation_4">
                    <input type="radio" id="motivation_4" name="motivation"
                           value="4" {if isset($smarty.post.motivation) && $smarty.post.motivation =="4"}checked{/if}>&nbsp;4</label>
                <label class="smileEgal radio-inline" for="motivation_5">
                    <input type="radio" id="motivation_5" name="motivation"
                           value="5" {if isset($smarty.post.motivation) && $smarty.post.motivation =="5"}checked{/if}>&nbsp;5</label>
                <label class="smileEgal radio-inline" for="motivation_6">
                    <input type="radio" id="motivation_6" name="motivation"
                           value="6" {if isset($smarty.post.motivation) && $smarty.post.motivation =="6"}checked{/if}>&nbsp;6</label>
                <label class="smileEgal radio-inline" for="motivation_7">
                    <input type="radio" id="motivation_7" name="motivation"
                           value="7" {if isset($smarty.post.motivation) && $smarty.post.motivation =="7"}checked{/if}>&nbsp;7</label>
                <label class="smileEgal radio-inline" for="motivation_8">
                    <input type="radio" id="motivation_8" name="motivation"
                           value="8" {if isset($smarty.post.motivation) && $smarty.post.motivation =="8"}checked{/if}>&nbsp;8</label>
                <label class="smileEgal radio-inline" for="motivation_9">
                    <input type="radio" id="motivation_9" name="motivation"
                           value="9" {if isset($smarty.post.motivation) && $smarty.post.motivation =="9"}checked{/if}>&nbsp;9</label>
                <label class="smileEgal radio-inline" for="motivation_10">
                    <input type="radio" id="motivation_10" name="motivation"
                           value="10" {if isset($smarty.post.motivation) && $smarty.post.motivation =="10"}checked{/if}>&nbsp;10</label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-xs-4 {if isset($errors['motivation_dernier_bilan'])}{$errors['motivation_dernier_bilan']}{/if}"
                   for="motivation_dernier_bilan_1">Par rapport à votre dernier bilan, cette
                motivation est-elle :</label>
            <div class="col-xs-8">
                <ul>
                    <li><input type="radio" id="motivation_dernier_bilan_1"
                               name="motivation_dernier_bilan"
                               value="progression"  {if isset($smarty.post.motivation_dernier_bilan) && $smarty.post.motivation_dernier_bilan =="progression"}checked{/if}><label
                                class="smileMoins" for="motivation_dernier_bilan_1"> en progression</label></li>
                    <li><input type="radio" id="motivation_dernier_bilan_2"
                               name="motivation_dernier_bilan"
                               value="regression" {if isset($smarty.post.motivation_dernier_bilan) && $smarty.post.motivation_dernier_bilan =="regression"}checked{/if}><label
                                class="smileEgal" for="motivation_dernier_bilan_2"> en régression</label></li>
                    <li><input type="radio" id="motivation_dernier_bilan_3"
                               name="motivation_dernier_bilan"
                               value="egale" {if isset($smarty.post.motivation_dernier_bilan) && $smarty.post.motivation_dernier_bilan =="egale"}checked{/if}><label
                                class="smileEgal" for="motivation_dernier_bilan_3"> égale</label></li>
                </ul>
            </div>
        </div>

        <div class="form-group">
            <div class="col-xs-5 col-sm-offset-4">
                <button type="submit" id="submitCarnet" name="submitCarnet"
                        class="btn btn-default button button-medium submitCarnet">
                    <span>Enregistrer<i class="icon-chevron-right right"></i></span>
                </button>
            </div>
        </div>
    </form>
{/if}



