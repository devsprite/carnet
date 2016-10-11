<?php

require_once(dirname(__FILE__) . '/CarnetClass.php');

class MailCarnetClass
{
    /**
     * @var Données client actuelles
     */
    public $data;

    /**
     * @var Données client précendantes
     */
    public $data_pre;

    public $customer;

    public $gender;

    public $inputsSante;

    public function __construct($data, $data_pre, $inputsSante)
    {
        $this->data = CarnetClass::getLastCarnet($data['id_customer']);
        $this->data_pre = $data_pre;
        $this->customer = new Customer($data['id_customer']);
        $this->gender = new Gender($this->customer->id_gender);

        $this->inputsSante = $inputsSante;

    }

    public function createMail()
    {
        $params = array();
        $params['{nom}'] = $this->gender->getFieldByLang('name') . ' ' . $this->customer->lastname;
        $params['{poids_actuel}'] = $this->messageSynthese();
        $params['{message_poids}'] = $this->messagePoids();
        $params['{message_taille}'] = $this->messageTaille();
        $params['{message_hanches}'] = $this->messageHanches();
        $params['{message_cuisse}'] = $this->messageCuisse();
        $params['{message_sante}'] = $this->messageSante();
        $params['{message_activite_physique}'] = $this->messageActivitePhysique();
        $params['{message_alimentation_suivi}'] = $this->messageAlimentationSuivi();
        $params['{message_alimentation_complements_alimentaires}'] = $this->messageAlimentationComplement();
        $params['{message_alimentation_eau_par_jour}'] = $this->messageAlimentationEau();
        $params['{message_alimentation_mange_entre_repas}'] = $this->messageAlimentationMangeEntreRepas();
        $params['{message_alimentation_repas_particulier}'] = $this->messageAlimentationRepasParticulier();
        $params['{message_alimentation_alimentation_plaisir}'] = $this->messageAlimentationPlaisir();
        $params['{message_programme_satisfaction_resultat}'] = $this->messageProgrammeSatisfaction();
        $params['{message_programme_resolution}'] = $this->messageProgrammeResolution();
        $params['{message_motivation}'] = $this->messageProgrammeMotivation();

        return $params;
    }

    private function messageSynthese()
    {
        $message = '';
        $message .= 'Aujourd\'hui vous êtes au poids de ' . $this->data['poids'] . ' kg.<br>';
        $message .= 'Vous avez un tour de taille de ' . $this->data['taille'] . ' cm.<br>';
        $message .= 'Vous avez un tour de hanches de ' . $this->data['hanches'] . ' cm.<br>';
        $message .= 'Vous avez un tour de cuisse de ' . $this->data['cuisse'] . ' cm.<br>';

        return $message;
    }

    private function messagePoids()
    {
        $message = $this->messageDifferrencePoids();
        return $message;
    }

    private function messageTaille()
    {
        $message = '';
        $message .= $this->messageDifferrenceTaille();
        return $message;
    }

    private function messageHanches()
    {
        $message = '';
        $message .= $this->messageDifferrenceHanches();
        return $message;
    }

    private function messageCuisse()
    {
        $message = '';
        $message .= $this->messageDifferrenceCuisse();
        return $message;
    }

    private function messageSante()
    {
        $message = '';
        if (!empty($this->data['inputs_sante'])) {
            $message .= '<ul>';
            $message .= $this->messageInputsSante();
            $message .= '</ul>';
        }

        return $message;
    }

    private function messageActivitePhysique()
    {
        $message = (!empty($this->data['activite_physique'])) ? $this->messageAnalyseActivitePhysique() : '';

        return $message;
    }

    private function messageAlimentationSuivi()
    {
        $message = (!empty($this->data['alimentation_suivi'])) ? $this->messageAnalyseSuiviAlimentation() : '';

        return $message;
    }

    private function messageAlimentationComplement()
    {
        $message = (!empty($this->data['alimentation_complements_alimentaires'])) ? $this->messageAnalyseComplement() : '';

        return $message;
    }

    private function messageAlimentationEau()
    {
        $message = (!empty($this->data['alimentation_eau_par_jour'])) ? $this->messageAnalyseEauParJour() : '';
        return $message;
    }

    private function messageAlimentationMangeEntreRepas()
    {
        $message = (!empty($this->data['alimentation_mange_entre_repas'])) ? $this->messageAnalyseMangeEntreRepas() : '';

        return $message;
    }

    private function messageAlimentationRepasParticulier()
    {
        $message = (!empty($this->data['alimentation_repas_particulier'])) ? $this->messageAnalyseRepasparticulier() : '';

        return $message;
    }

    private function messageAlimentationPlaisir()
    {
        $message = (!empty($this->data['alimentation_plaisir'])) ? $this->messageAnalysePlaisir() : '';

        return $message;
    }

    private function messageProgrammeSatisfaction()
    {
        $message = (!empty($this->data['programme_satisfaction_resultat'])) ? $this->messageAnalyseProgrammeSatisfaction() : '';

        return $message;
    }

    private function messageProgrammeResolution()
    {
        $message = (!empty($this->data['programme_resolution'])) ? $this->messageAnalyseProgrammeResolution() : '';

        return $message;
    }

    private function messageProgrammeMotivation()
    {
        $message = (!empty($this->data['motivation'])) ? $this->messageAnalyseProgrammeMotivation() : '';
        return $message;
    }


    //***********************//

    private function messageDifferrencePoids()
    {
        $message = '';
        if ($this->data_pre['poids_differrence']) {
            $message = 'Depuis votre dernier bilan du ' . date('j-m-Y', strtotime($this->data_pre['date_upd'])) . ', ';

            if (floatval($this->data['poids_differrence']) === floatval(0)) {
                $message .= ' vous avez stagné.';
            } else if (floatval($this->data['poids_differrence']) > floatval(0)) {
                $message .= ' vous avez pris ' . floatval($this->data['poids_differrence']) . ' kg.';
            } else {
                $message .= ' vous avez perdu ' . abs(floatval($this->data['poids_differrence'])) . ' kg. Bravo pour vos efforts.';
            }
            return $message;
        }

    }

    private function messageDifferrenceTaille()
    {
        $message = '';
        if ($this->data_pre['taille']) {

            if (floatval($this->data['taille_differrence']) === floatval(0)) {
                $message .= 'Votre taille n\'a pas changée.';
            } else if (floatval($this->data['taille_differrence']) > floatval(0)) {
                $message .= 'Votre taille a augmentée de ' . floatval($this->data['taille_differrence']) . ' cm.';
            } else {
                $message .= 'Votre taille a diminuée de ' . abs(floatval($this->data['taille_differrence'])) . ' cm. Bravo pour vos efforts.';
            }
            return $message;
        }

    }

    private function messageDifferrenceHanches()
    {
        $message = '';
        if ($this->data_pre['hanches']) {

            if (floatval($this->data['hanches_differrence']) === floatval(0)) {
                $message .= 'Votre tour de hanches n\'a pas changée.';
            } else if (floatval($this->data['hanches_differrence']) > floatval(0)) {
                $message .= 'Votre tour de hanches a augmentée de ' . floatval($this->data['hanches_differrence']) . ' cm.';
            } else {
                $message .= 'Votre tour de hanches a diminuée de ' . abs(floatval($this->data['hanches_differrence'])) . ' cm. Bravo pour vos efforts.';
            }
            return $message;
        }

    }

    private function messageDifferrenceCuisse()
    {
        $message = '';
        if ($this->data_pre['cuisse']) {

            if (floatval($this->data['cuisse_differrence']) === floatval(0)) {
                $message .= 'Votre tour de cuisse n\'a pas changé.';
            } else if (floatval($this->data['cuisse_differrence']) > floatval(0)) {
                $message .= 'Votre tour de cuisse a augmenté de ' . floatval($this->data['cuisse_differrence']) . ' cm.';
            } else {
                $message .= 'Votre tour de cuisse a diminué de ' . abs(floatval($this->data['cuisse_differrence'])) . ' cm. Bravo pour vos efforts.';
            }
            return $message;
        }

    }

    private function messageAnalyseActivitePhysique()
    {
        $message = '';
        if ($this->data['activite_physique'] == 'Oui, comme a votre habitude') {
            $duree = date('g \h\e\u\r\e\(\s\) \e\t i \s\e\c\o\n\d\e\(\s\)', strtotime(Tools::getValue('activite_physique_heure')));
            $message = 'Vous avez pratiqué une activité physique';
            $message .= ($this->data['activite_physique_heure']) ? ', durant ' . $duree . '.' : '.';
        }

        if ($this->data['activite_physique'] == 'Oui, vous avez fait l effort') {
            $message = 'Vous avez pratiqué une activité physique.';
        }

        if ($this->data['activite_physique'] == 'Pas vraiment, mais c est en projet') {
            $message = 'Vous n\'avez pas pratiqué d\'activité physique.';
        }

        return $message;
    }

    private function messageInputsSante()
    {

        $message = '';
        $inputsKey = explode(',', $this->data['inputs_sante']);
        foreach ($inputsKey as $v) {
            $message .= '<li>' . $this->inputsSante[$v][1] . '</li>';
        }

        return $message;
    }


    private function messageSanteDigestif()
    {
        $message = '';
        if (!empty($this->data['sante_digestif'])) {
            $message = '<li>Durant la semaine écoulée, vous avez eu des troubles digestifs.</li>';
        }
        return $message;
    }

    private function messageSanteTransit()
    {
        $message = '';
        if (!empty($this->data['sante_transit'])) {
            $message = '<li>Durant la semaine écoulée, vous avez eu des problèmes de transit</li>';
        }
        return $message;
    }

    private function messageSanteStress()
    {
        $message = '';
        if (!empty($this->data['sante_stress'])) {
            $message = '<li>Durant la semaine écoulée, vous avez été particulièrement stressé(e)</li>';
        }
        return $message;
    }

    private function messageSanteFatigue()
    {
        $message = '';
        if (!empty($this->data['sante_fatigue'])) {
            $message = '<li>Durant la semaine écoulée, vous avez été particulièrement fatigué(e)</li>';
        }
        return $message;
    }

    private function messageSanteSommeil()
    {
        $message = '';
        if (!empty($this->data['sante_sommeil'])) {
            $message = '<li>Durant la semaine écoulée, vous avez eu des problèmes de sommeil</li>';
        }
        return $message;
    }

    private function messageSanteMedical()
    {
        $message = '';
        if (!empty($this->data['sante_medical'])) {
            $message = '<li>Durant la semaine écoulée, vous avez eu un problème de santé</li>';
        }
        return $message;
    }

    private function messageAnalyseSuiviAlimentation()
    {
        $message = '';
        if ($this->data['alimentation_suivi'] = 'Oui') {
            $message .= 'Vous avez suivi la méthode alimentaire avec facilité.';
        } else if ($this->data['alimentation_suivi'] == 'Non') {
            $message .= 'Vous avez essayé mais vous avez eu du mal à appliquer la méthode alimentaire.';
        } else {
            $message .= 'Vous n\'avez pas l\'intention de suivre la méthode laimentaire.';
        }

        return $message;
    }

    private function messageAnalyseComplement()
    {
        $message = '';
        if ($this->data['alimentation_complements_alimentaires'] = 'Oui') {
            $message .= 'Vous avez bien pris vos compléments selon les dosages préconisés par votre coach.';
        } else {
            $message .= 'Vous n\'avez pas pris vos compléments selon les dosages préconisés par votre coach.';
        }

        return $message;
    }

    private function messageAnalyseEauParJour()
    {
        $message = '';
        if ($this->data['alimentation_eau_par_jour'] = 'Oui') {
            $message .= 'Vous avez bu au moins 1,5 litre d\'eau par jour.';
        } else {
            $message .= 'Vous n\'avez pas suffisament bu d\'eau par jour.';
        }

        return $message;
    }

    private function messageAnalyseMangeEntreRepas()
    {
        $message = '';
        if ($this->data['alimentation_mange_entre_repas'] = 'Oui collation') {
            $message .= 'Vous avez eu faim, et pris des collations.';
        } else if ($this->data['alimentation_mange_entre_repas'] = 'Oui grignote') {
            $message .= 'Vosu avez grignoté.';
        } else {
            $message .= 'Vous n\'avez pas mangé entre les repas.';
        }
        return $message;
    }

    private function messageAnalyseRepasparticulier()
    {
        $message = '';

        if (
            $this->data['alimentation_repas_particulier'] == 'Oui' &&
            $this->data['alimentation_respect_methode'] == 'Oui'
        ) {
            $message .= 'Vous avez mangé dehors une ou plusieurs fois et vous avez réussi à respecter la méthode.';
        } else if (
            $this->data['alimentation_repas_particulier'] == 'Oui' &&
            $this->data['alimentation_respect_methode'] == 'Non'
        ) {
            $message .= 'Vous avez mangé dehors une ou plusieurs fois sans réussir à respecter la méthode.';
        } else if ($this->data['alimentation_repas_particulier'] == 'Non') {
            $message .= 'Vous n\'avez pas mangé dehors';
        }
        return $message;
    }

    private function messageAnalysePlaisir()
    {
        $message = '';
        if (!empty($this->data['alimentation_plaisir'])) {
            $message .= 'Au niveau alimentaire, vous avez aimé ' . $this->data['alimentation_plaisir'];
        }
        if (!empty($this->data['alimentation_frustration'])) {
            $message .= ', et ' . $this->data['alimentation_frustration'] . ' vous ont frustré(e).';
        }

        return $message;
    }

    private function messageAnalyseProgrammeSatisfaction()
    {
        $message = '';
        $positif = ((int)$this->data['programme_satisfaction_resultat'] > 7) ? 'très' : '';
        $negatif = ((int)$this->data['programme_satisfaction_resultat'] < 3) ? 'du tout' : '';

        if ((int)$this->data['programme_satisfaction_resultat'] >= 5) {
            $message .= 'Vous êtes ' . $positif . ' satifaite de vos résultats,';
            if ($this->data['programme_satisfaction_semaine'] == 'Oui') {
                $message .= ' et de ce que vous avez accompli.';
            } else {
                $message .= '.';
            }
        } else {
            $message .= 'Vous n\'êtes pas ' . $negatif . ' satisfaite de vos résultats';
        }

        return $message;
    }

    private function messageAnalyseProgrammeResolution()
    {
        $message = '';
        if (!empty($this->data['programme_resolution'])) {
            $message .= 'Votre ou vos bonnes résolutions pour la semaine à venir : ' . $this->data['programme_resolution'];
        }
        return $message;
    }

    private function messageAnalyseProgrammeMotivation()
    {
        $message = '';
        $positif = ((int)$this->data['motivation'] > 7) ? 'très' : '';
        $negatif = ((int)$this->data['motivation'] < 3) ? 'du tout' : '';

        if ((int)$this->data['motivation'] >= 5) {
            $message .= 'Vous êtes ' . $positif . ' motivée pour la semaine aui arrive.';
        } else {
            $message .= 'Vous n\'êtes pas ' . $negatif . ' motivée pour la semaine qui arrive.';
        }
        return $message;
    }


}