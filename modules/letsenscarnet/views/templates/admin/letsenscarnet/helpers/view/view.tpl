<div class="panel">
    <div class="row panel">
        <h2 class="col-xs-4">
            {if isset($carnet->customer_name)}{$carnet->customer_name}{/if} suivi
            par {if isset($carnet->name_contact)}{$carnet->name_contact}{/if}&nbsp;
        </h2>
    </div>
    <div class="row panel">
        <div class="col-xs-4">Date du bilan :</div>
        <div class="col-xs-8">{if isset($carnet->date_add)}{$carnet->date_add}{/if}&nbsp;
        {if isset($carnet->date_upd) && $carnet->date_upd != $carnet->date_add} -- Modifié le {$carnet->date_upd}{/if}
        </div>
    </div>

    <div class="row panel">
        <h2>Mensuration - poids</h2>
        <div class="row">
            <div class="col-xs-4">Aujourd'hui, quel est votre poids (en kg) ?</div>
            <div class="col-xs-8">{if isset($carnet->poids)}{$carnet->poids} kg{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Depuis votre dernier bilan, votre poids a...</div>
            <div class="col-xs-8">{if isset($carnet->poids_evolution)}{$carnet->poids_evolution}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Si votre poids a évolué depuis votre dernier bilan, veuillez indiquer de combien :
            </div>
            <div class="col-xs-8">{if isset($carnet->poids_differrence)}{$carnet->poids_differrence} kg{/if}&nbsp;</div>
        </div>
    </div>

    <div class="row panel">
        <h2>MENSURATION - TOUR DE TAILLE</h2>
        <div class="row">
            <div class="col-xs-4">Aujourd'hui, quel est votre tour de taille (en cm) ?</div>
            <div class="col-xs-8">{if isset($carnet->taille)}{$carnet->taille} cm{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Depuis votre dernier bilan, votre tour de taille a...</div>
            <div class="col-xs-8">{if isset($carnet->taille_evolution)}{$carnet->taille_evolution}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Si votre tour de taille a évolué depuis votre dernier bilan, veuillez indiquer de
                combien
                :
            </div>
            <div class="col-xs-8">{if isset($carnet->taille_differrence)}{$carnet->taille_differrence} cm{/if}
                &nbsp;</div>
        </div>
    </div>

    <div class="row panel">
        <h2>MENSURATION - TOUR DE HANCHES</h2>
        <div class="row">
            <div class="col-xs-4">Aujourd'hui, quel est votre tour de hanches (en cm) ?</div>
            <div class="col-xs-8">{if isset($carnet->hanches)}{$carnet->hanches} cm{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Depuis votre dernier bilan, votre tour de hanches a...</div>
            <div class="col-xs-8">{if isset($carnet->hanches_evolution)}{$carnet->hanches_evolution}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Si votre tour de hanches a évolué depuis votre dernier bilan, veuillez indiquer de
                combien:
            </div>
            <div class="col-xs-8">{if isset($carnet->hanches_differrence)}{$carnet->hanches_differrence} cm{/if}
                &nbsp;</div>
        </div>
    </div>

    <div class="row panel">
        <h2>MENSURATION - TOUR DE CUISSE</h2>
        <div class="row">
            <div class="col-xs-4">Aujourd'hui, quel est votre tour de cuisse (en cm) ?</div>
            <div class="col-xs-8">{if isset($carnet->cuisse)}{$carnet->cuisse} cm{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Depuis votre dernier bilan, votre tour de cuisse a...</div>
            <div class="col-xs-8">{if isset($carnet->cuisse_evolution)}{$carnet->cuisse_evolution}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Si votre tour de cuisse a évolué depuis votre dernier bilan, veuillez indiquer de
                combien
                :
            </div>
            <div class="col-xs-8">{if isset($carnet->cuisse_differrence)}{$carnet->cuisse_differrence} cm{/if}
                &nbsp;</div>
        </div>
    </div>

    <div class="row panel">
        <h2>SANTÉ</h2>
        <div class="row">
            <div class="col-xs-4">Durant la semaine écoulée...Vous avez eu des troubles digestifs</div>
            <div class="col-xs-8">{if isset($carnet->sante_digestif)}{$carnet->sante_digestif}{/if}&nbsp;</div>
            <div class="col-xs-4">Durant la semaine écoulée...Vous avez eu des problèmes de transit</div>
            <div class="col-xs-8">{if isset($carnet->sante_transit)}{$carnet->sante_transit}{/if}&nbsp;</div>
            <div class="col-xs-4">Durant la semaine écoulée...Vous avez été particulièrement stressé(e)</div>
            <div class="col-xs-8">{if isset($carnet->sante_stress)}{$carnet->sante_stress}{/if}&nbsp;</div>
            <div class="col-xs-4">Durant la semaine écoulée...Vous avez été particulièrement fatigué(e)</div>
            <div class="col-xs-8">{if isset($carnet->sante_fatigue)}{$carnet->sante_fatigue}{/if}&nbsp;</div>
            <div class="col-xs-4">Durant la semaine écoulée...Vous avez eu des problèmes de sommeil</div>
            <div class="col-xs-8">{if isset($carnet->sante_sommeil)}{$carnet->sante_sommeil}{/if}&nbsp;</div>
            <div class="col-xs-4">Durant la semaine écoulée...Vous avez eu un problème de santé</div>
            <div class="col-xs-8">{if isset($carnet->sante_medical)}{$carnet->sante_medical}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Autre</div>
            <div class="col-xs-8">{if isset($carnet->sante_autre)}{$carnet->sante_autre}{/if}&nbsp;</div>
        </div>
    </div>

    <div class="row panel">
        <h2>ACTIVITÉ PHYSIQUE</h2>
        <div class="row">
            <div class="col-xs-4">Durant la semaine écoulée, avez-vous pratiqué une activité sportive ?</div>
            <div class="col-xs-8">{if isset($carnet->activite_physique)}{$carnet->activite_physique}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Si oui, combien d'heures dans la semaine (en tout) ?</div>
            <div class="col-xs-8">{if isset($carnet->activite_physique_heure)}{$carnet->activite_physique_heure}{/if}
                &nbsp;</div>
        </div>
    </div>

    <div class="row panel">
        <h2>ALIMENTATION</h2>
        <div class="row">
            <div class="col-xs-4">Avez-vous eu faim ?</div>
            <div class="col-xs-8">{if isset($carnet->alimentation_faim)}{$carnet->alimentation_faim}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Cette semaine, avez-vous bien suivi la méthode diététique Ligne&Sens ?</div>
            <div class="col-xs-8">{if isset($carnet->alimentation_suivi)}{$carnet->alimentation_suivi}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Avez-vous pris vos compléments alimentaires L&Sens régulièrement ?</div>
            <div class="col-xs-8">{if isset($carnet->alimentation_complements_alimentaires)}{$carnet->alimentation_complements_alimentaires}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Avez-vous bu 1,5 litre d'eau par jour ?</div>
            <div class="col-xs-8">{if isset($carnet->alimentation_eau_par_jour)}{$carnet->alimentation_eau_par_jour}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Avez-vous mangé entre les repas ?</div>
            <div class="col-xs-8">{if isset($carnet->alimentation_mange_entre_repas)}{$carnet->alimentation_mange_entre_repas}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Avez-vous pris un ou plusieurs repas dans des situations particulières ? (Restaurant,
                repas de fête, invitation...)
            </div>
            <div class="col-xs-8">{if isset($carnet->alimentation_repas_particulier)}{$carnet->alimentation_repas_particulier}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Si oui, avez-vous tout de même respecté la méthode diététique ces jours-là ?</div>
            <div class="col-xs-8">{if isset($carnet->alimentation_respect_methode)}{$carnet->alimentation_respect_methode}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Au niveau alimentaire cette semaine, quelles ont été vos sources de plaisir ?</div>
            <div class="col-xs-8">{if isset($carnet->alimentation_plaisir)}{$carnet->alimentation_plaisir}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Au niveau alimentaire cette semaine, quelles ont été vos sources de frustration ?
            </div>
            <div class="col-xs-8">{if isset($carnet->alimentation_frustration)}{$carnet->alimentation_frustration}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Autre</div>
            <div class="col-xs-8">{if isset($carnet->alimentation_faim_autre)}{$carnet->alimentation_faim_autre}{/if}
                &nbsp;</div>
        </div>
    </div>

    <div class="row panel">
        <h2>VOTRE PROGRAMME ET VOUS - SATISFACTION</h2>
        <div class="row">
            <div class="col-xs-4">Aujourd'hui, quel est votre degré de satisfaction à l'égard de vos résultats ?</div>
            <div class="col-xs-8">{if isset($carnet->programme_satisfaction_resultat)}{$carnet->programme_satisfaction_resultat}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Etes-vous satisfait(e) de ce que VOUS avez accompli cette semaine ?</div>
            <div class="col-xs-8">{if isset($carnet->programme_satisfaction_semaine)}{$carnet->programme_satisfaction_semaine}{/if}
                &nbsp;</div>
        </div>

        <div class="row">
            <div class="col-xs-4">Autre</div>
            <div class="col-xs-8">{if isset($carnet->programme_satisfaction_semaine_autre)}{$carnet->programme_satisfaction_semaine_autre}{/if}
                &nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Notez ici une résolution que vous décidez de mettre en oeuvre dans la semaine qui
                vient
                :
            </div>
            <div class="col-xs-8">{if isset($carnet->programme_resolution)}{$carnet->programme_resolution}{/if}
                &nbsp;</div>
        </div>
    </div>
    <div class="row panel">
        <h2>VOTRE PROGRAMME ET VOUS - MOTIVATION</h2>

        <div class="row">
            <div class="col-xs-4">Aujourd'hui, comment évaluez-vous votre motivation ?</div>
            <div class="col-xs-8">{if isset($carnet->motivation)}{$carnet->motivation}{/if}&nbsp;</div>
        </div>
        <div class="row">
            <div class="col-xs-4">Par rapport à votre dernier bilan, cette motivation est-elle :</div>
            <div class="col-xs-8">{if isset($carnet->motivation_dernier_bilan)}{$carnet->motivation_dernier_bilan}{/if}
                &nbsp;</div>
        </div>
    </div>
</div>
