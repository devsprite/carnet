{capture name=path}{l s='Mon carnet' mod='letsenscarnet'}{/capture}
{include file="$tpl_dir./errors.tpl"}

{if $confirmation}
    <p class="alert alert-success">{$confirmation}</p>
{elseif isset($carnet) && $carnet}

    <div class="row box">
        <div class="row box">
            <h1 class="page-heading bottom-indent pull-left">
                Carnet rempli le {$carnet['date_add']|date_format:"%A %x"}
            </h1>
            <form action="" method="post">
                <button class="btn btn-warning pull-right" value="{$carnet['id_carnet']}" name="delete"
                onclick="if(confirm('Etes-vous sur de vouloir supprimer ce carnet ?')) {} else return false">Supprimer
                </button>
                <button type="submit" class="btn btn-primary pull-right" name="update"
                        value="{$carnet['id_carnet']}"> Modifier
                </button>
            </form>
        </div>

        <div class="box">
            <h4><strong>Poids</strong></h4>
            <p>Poids : {$carnet['poids']} kg</p>
            {if $carnet['poids_evolution']}
                <p>Votre poids a {$carnet['poids_evolution']}</p>
                <p>Votre poids a évolué de : {$carnet['poids_differrence']} kg</p>
            {/if}
        </div>
        <div class="box">
            <h4><strong>Tour de taille</strong></h4>
            <p>Taille : {$carnet['taille']} cm</p>
            {if $carnet['taille_evolution']}
                <p>Votre taille a {$carnet['taille_evolution']}e</p>
                <p>Votre taille a évolué de : {$carnet['taille_differrence']} cm</p>
            {/if}
        </div>
        <div class="box">
            <h4><strong>Tour de hanches</strong></h4>
            <p>Hanches : {$carnet['hanches']} cm</p>
            {if $carnet['hanches_evolution']}
                <p>La taille de vos hanches ont {$carnet['hanches_evolution']}es</p>
                <p>Va taille de vos hanches ont évoluées de : {$carnet['hanches_differrence']} cm</p>
            {/if}
        </div>
        <div class="box">
            <h4><strong>Tour de cuisse</strong></h4>
            <p>Cuisse : {$carnet['cuisse']} cm</p>
            {if $carnet['taille_evolution']}
                <p>La taille de votre cuisse a {$carnet['taille_evolution']}e</p>
                <p>La taille de votre cuisse a évoluée de : {$carnet['taille_differrence']} cm</p>
            {/if}
        </div>
        {if !empty($inputs_sante) || !empty($carnet['sante_autre'])}
            <div class="box">
                <h4><strong>Durant la semaine écoulée...</strong></h4>
                {if !empty($inputs_sante)}
                    {foreach item=input from=$inputs_sante}
                        <p>{$input}</p>
                    {/foreach}
                {/if}
                {if $carnet['sante_autre']}<p>Autre : {$carnet['sante_autre']}</p>{/if}
            </div>
        {/if}
        {if !empty($carnet['activite_physique'])}
            <div class="box">
                <h4><strong>Durant la semaine écoulée, avez-vous pratiqué une activité sportive ?</strong></h4>
                {if $carnet['activite_physique'] == 'Oui_comme_a_votre_habitude'}<p>Oui, comme à votre habitude</p>{/if}
                {if $carnet['activite_physique'] == 'Oui_vous_avez_fait_l_effort'}
                    <p>Oui, vous avez fait l'effort</p>
                {/if}
                {if $carnet['activite_physique'] == 'Pas_vraiment_mais_c_est_en_projet'}
                    <p>Pas vraiment, mais c'est en projet</p>
                {/if}
                {if $carnet['activite_physique'] == 'Non_vous_etes_définitivement_faché'}
                    <p>Non, vous êtes définitivement faché(e) avec le sport</p>
                {/if}
                {if $carnet['activite_physique'] == 'Non_vous_ne_pouvez_pas_pratiquer_d_activité_sportive'}
                    <p>Non, vous ne pouvez pas pratiquer d'activité sportive (raisons de santé)</p>
                {/if}
                {if !empty($carnet['activite_physique_heure'])}<p>Vous avez pratiqué une activité physique
                    durant {$carnet['activite_physique_heure']} heure(s)</p>{/if}
            </div>
        {/if}

        <div class="box">
            {if $carnet['alimentation_faim']}
                <h4><strong>Avez-vous eu faim ?</strong></h4>
                {$carnet['alimentation_faim']}
            {/if}
            {if $carnet['alimentation_faim_autre']}
                <h4><strong>Autre : </strong></h4>
                {$carnet['alimentation_faim_autre']}
            {/if}
            {if $carnet['alimentation_suivi']}
                <h4><strong>Cette semaine, avez-vous bien suivi la méthode diététique Ligne&Sens ?</strong></h4>
                {if $carnet['alimentation_suivi'] == 'Oui'}<p>Oui</p>{/if}
                {if $carnet['alimentation_suivi'] == 'Non'}<p>Non, je n'ai pas l'intention de la suivre</p>{/if}
                {if $carnet['alimentation_suivi'] == '<p>J_essai_mais_difficile'}J'essaie, mais c'est parfois difficile</p>{/if}
            {/if}
            {if $carnet['alimentation_complements_alimentaires']}
                <h4><strong>Avez-vous pris vos compléments alimentaires L&Sens régulièrement ?</strong></h4>
                {$carnet['alimentation_complements_alimentaires']}
            {/if}
            {if $carnet['alimentation_eau_par_jour']}
                <h4><strong>Avez-vous bu 1,5 litre d'eau par jour ?</strong></h4>
                {$carnet['alimentation_eau_par_jour']}
            {/if}
            {if $carnet['alimentation_mange_entre_repas']}
                <h4><strong>Avez-vous mangé entre les repas ?</strong></h4>
                {if $carnet['alimentation_mange_entre_repas'] == 'Non'}<p>Non, jamais</p>{/if}
                {if $carnet['alimentation_mange_entre_repas'] == 'Oui_collation'}
                    <p>Oui, vous avez eu faim et pris des collations (en milieu de matinée ou milieu d'après-midi)</p>
                {/if}
                {if $carnet['alimentation_mange_entre_repas'] == 'Oui_grignote'}
                    <p>Oui, vous avez grignoté par-ci par-là (hors collations)</p>
                {/if}
            {/if}
            {if $carnet['alimentation_repas_particulier']}
                <h4><strong>Avez-vous pris un ou plusieurs repas dans des situations particulières ? (Restaurant, repas
                        de fête, invitation...)</strong></h4>
                {$carnet['alimentation_repas_particulier']}
            {/if}
            {if $carnet['alimentation_respect_methode']}
                <h4><strong>Si oui, avez-vous tout de même respecté la méthode diététique ces jours-là ?</strong></h4>
                {$carnet['alimentation_respect_methode']}
            {/if}
            {if $carnet['alimentation_plaisir']}
                <h4><strong>Au niveau alimentaire cette semaine, quelles ont été vos sources de plaisir ?</strong></h4>
                {$carnet['alimentation_plaisir']}
            {/if}
            {if $carnet['alimentation_frustration']}
                <h4><strong>Au niveau alimentaire cette semaine, quelles ont été vos sources de frustration ?</strong>
                </h4>
                {$carnet['alimentation_frustration']}
            {/if}
        </div>
        <div class="box">
            {if $carnet['programme_satisfaction_resultat']}
                <h4><strong>Aujourd'hui, quel est votre degré de satisfaction à l'égard de vos résultats ?</strong></h4>
                Note de : {$carnet['programme_satisfaction_resultat']}
            {/if}
            {if $carnet['programme_satisfaction_semaine']}
                <h4><strong>Etes-vous satisfait(e) de ce que VOUS avez accompli cette semaine ?</strong></h4>
                {$carnet['programme_satisfaction_semaine']}
            {/if}
            {if $carnet['programme_satisfaction_semaine_autre']}
                <h4><strong>Autre : </strong></h4>
                {$carnet['programme_satisfaction_semaine_autre']}
            {/if}
            {if $carnet['programme_resolution']}
                <h4><strong>Notez ici une résolution que vous décidez de mettre en oeuvre dans la semaine qui vient
                        : </strong></h4>
                {$carnet['programme_resolution']}
            {/if}
        </div>
        <div class="box">
            {if $carnet['motivation']}
                <h4><strong>Aujourd'hui, comment évaluez-vous votre motivation ?</strong></h4>
                Note : {$carnet['motivation']}
            {/if}
            {if $carnet['motivation_dernier_bilan']}
                <h4><strong>Par rapport à votre dernier bilan, cette motivation est :</strong></h4>
                {if $carnet['motivation_dernier_bilan'] == 'progression'}En progression{/if}
                {if $carnet['motivation_dernier_bilan'] == 'regression'}En régression{/if}
                {if $carnet['motivation_dernier_bilan'] == 'egale'}Egale{/if}
            {/if}
        </div>

    </div>
{else}
    <p>Vous n'avez pas encore rempli de carnet</p>
{/if}