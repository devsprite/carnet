<?php

require_once(dirname(__FILE__) . '/../../classes/CarnetClass.php');

class AdminLetsenscarnetController extends ModuleAdminController
{
    public function __construct()
    {
        $this->table = 'carnet';
        $this->module = 'letsenscarnet';
        $this->className = 'CarnetClass';
        $this->lang = false;
        $this->identifier = 'id_carnet';
        $this->bootstrap = true;
        $this->context = Context::getContext();
        $this->_orderBy = 'id_carnet';
        $this->_orderWay = 'DESC';

        $this->fields_list = array(
            'id_carnet' => array(
                'title' => 'ID',
                'align' => 'center',
                'class' => 'fixed-width-xs'
            ),
            'date_add' => array(
                'title' => $this->l('Date'),
                'align' => 'center',
                'class' => 'col-xs-1',
                'search' => 'true',
                'callback' => 'formatDate'
            ),
            'name_contact' => array(
                'title' => $this->l('Coach'),
                'align' => 'center',
                'class' => 'col-xs-1',
                'search' => 'true'
            ),
            'customer_name' => array(
                'title' => $this->l('Client'),
                'align' => 'center',
                'class' => 'col-xs-1',
            ),
            'poids' => array(
                'title' => $this->l('Poids'),
                'align' => 'center',
                'class' => 'col-xs-1',
            ),
//            'poids_evolution' => array(
//                'title' => $this->l('P. Evol.'),
//                'align' => 'center',
//                'class' => 'col-xs-1'
//            ),
            'poids_differrence' => array(
                'title' => $this->l('P. Diff.'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
            'taille' => array(
                'title' => $this->l('Taille'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
//            'taille_evolution' => array(
//                'title' => $this->l('T. Evol.'),
//                'align' => 'center',
//                'class' => 'col-xs-1'
//            ),
            'taille_differrence' => array(
                'title' => $this->l('T. Diff.'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
            'hanches' => array(
                'title' => $this->l('Hanches'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
//            'hanches_evolution' => array(
//                'title' => $this->l('H. Evol.'),
//                'align' => 'center',
//                'class' => 'col-xs-1'
//            ),
            'hanches_differrence' => array(
                'title' => $this->l('H. Diff.'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
            'cuisse' => array(
                'title' => $this->l('Cuisse'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
//            'cuisse_evolution' => array(
//                'title' => $this->l('C. Evol.'),
//                'align' => 'center',
//                'class' => 'col-xs-1'
//            ),
            'cuisse_differrence' => array(
                'title' => $this->l('C. Diff.'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
            'sante_digestif' => array(
                'title' => $this->l('P. Digestif'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
            'sante_transit' => array(
                'title' => $this->l('P. Sante'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
            'sante_stress' => array(
                'title' => $this->l('P. Stress'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
            'sante_fatigue' => array(
                'title' => $this->l('P. Fatigue'),
                'align' => 'center',
                'class' => 'col-xs-1'
            ),
        );

        $this->bulk_action = array(
            'delete' => array(
                'text' => $this->l('Delete selected'),
                'icon' => 'icon-trash',
                'confirm' => $this->l('Delete selected items?')
            )
        );

        parent::__construct();
    }

    public function renderList()
    {
        if (isset($this->_filter) && trim($this->_filter) == '')
            $this->_filter = $this->original_filter;

        $this->addRowAction('view');
        $this->addRowAction('add');
        $this->addRowAction('edit');
        $this->addRowAction('delete');

        return parent::renderList();
    }

    public function initPageHeaderToolbar()
    {
        if (!$this->display) {
            $this->page_header_toolbar_btn['new'] = array(
                'href' => self::$currentIndex . '&add' . $this->table . '&token=' . $this->token,
                'desc' => $this->l('Add New')
            );
        } else if ($this->display == 'view') {
            $this->page_header_toolbar_btn['back'] = array(
                'href' => self::$currentIndex . '&token=' . $this->token,
                'desc' => $this->l('Back to the list')
            );
        }

        parent::initPageHeaderToolbar();
    }

    public function renderForm()
    {
        $oui_non = array(
            array('id_option' => '', 'name' => ''),
            array('id_option' => 'Oui', 'name' => 'Oui'),
            array('id_option' => 'Non', 'name' => 'Non'),
        );

        $evolution = array(
            array('name' => '', 'id_option' => ''),
            array('name' => 'diminué', 'id_option' => 'diminué'),
            array('name' => 'stagné', 'id_option' => 'stagné'),
            array('name' => 'augmenté', 'id_option' => 'augmenté'),
        );

        $inputs[] = array(
            'type' => 'text',
            'name' => 'customer_name',
            'label' => 'Client',
            'class' => 'col-xs-3',
            'suffix' => '...',
            'required' => 'true'

        );

        $inputs[] = array(
            'type' => 'hidden',
            'name' => 'id_customer',
            'required' => 'true'
        );


        $contacts = $this->getContacts();

        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Votre Coach'),
            'name' => 'name_contact',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'required' => 'true',
            'options' => array(
                'query' => $contacts,
                'id' => 'id_contact',
                'name' => 'name'
            )
        );

        // Poids
        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Aujourd\'hui, quel est votre poids (en kg) ?'),
            'name' => 'poids',
            'suffix' => 'kg',
            'class' => 'col-xs-3',
            'required' => 'true'
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Depuis votre dernier bilan, votre poids a...'),
            'name' => 'poids_evolution',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $evolution,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Si votre poids a évolué depuis votre dernier bilan, veuillez indiquer de combien :'),
            'name' => 'poids_differrence',
            'suffix' => 'kg',
            'class' => 'col-xs-3',
        );


        // Taille
        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Aujourd\'hui, quel est votre tour de taille (en cm) ?'),
            'name' => 'taille',
            'suffix' => 'cm',
            'class' => 'col-xs-3',
            'required' => 'true'
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Depuis votre dernier bilan, votre tour de taille a...'),
            'name' => 'taille_evolution',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $evolution,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Si votre tour de taille a évolué depuis votre dernier bilan, veuillez indiquer de combien :'),
            'name' => 'taille_differrence',
            'suffix' => 'cm',
            'class' => 'col-xs-3',
        );

        // Tour de hanches
        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Aujourd\'hui, quel est votre tour de hanches (en cm) ?'),
            'name' => 'hanches',
            'suffix' => 'cm',
            'class' => 'col-xs-3',
            'required' => 'true'
        );

        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Depuis votre dernier bilan, votre tour de hanches a...'),
            'name' => 'hanches_evolution',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $evolution,
                'id' => 'id_option',
                'name' => 'name'
            )
        );

        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Si votre tour de hanches a évolué depuis votre dernier bilan, veuillez indiquer de combien:'),
            'name' => 'hanches_differrence',
            'suffix' => 'cm',
            'class' => 'col-xs-3',
        );

        // Tour de cuisse
        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Aujourd\'hui, quel est votre tour de cuisse (en cm) ?'),
            'name' => 'cuisse',
            'suffix' => 'cm',
            'class' => 'col-xs-3',
            'required' => 'true'
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Depuis votre dernier bilan, votre tour de cuisse a...'),
            'name' => 'cuisse_evolution',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $evolution,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Si votre tour de cuisse a évolué depuis votre dernier bilan, veuillez indiquer de combien :'),
            'name' => 'cuisse_differrence',
            'suffix' => 'cm',
            'class' => 'col-xs-3',
        );

        // santé

        $inputs[] =
            array(
                'type' => 'select',
                'label' => $this->l('Durant la semaine écoulée... Vous avez eu des troubles digestifs'),
                'name' => 'sante_digestif',
                'options' => array(
                    'query' => array(
                        array('id_option' => '', 'name' => 'Non'),
                        array('id_option' => 'troubles_digestifs', 'name' => 'Oui'),
                    ),
                    'id' => 'id_option',
                    'name' => 'name'
                ));

        $inputs[] =
            array(
                'type' => 'select',
                'label' => $this->l('Durant la semaine écoulée... Vous avez eu des problèmes de transit'),
                'name' => 'sante_transit',
                'options' => array(
                    'query' => array(array('id_option' => '', 'name' => 'Non'), array('id_option' => 'problemes_de_transit', 'name' => 'Oui')),
                    'id' => 'id_option',
                    'name' => 'name'
                ));

        $inputs[] =
            array(
                'type' => 'select',
                'label' => $this->l('Durant la semaine écoulée... Vous avez été particulièrement stressé(e)'),
                'name' => 'sante_stress',
                'options' => array(
                    'query' => array(array('id_option' => '', 'name' => 'Non'), array('id_option' => 'stress', 'name' => 'Oui')),
                    'id' => 'id_option',
                    'name' => 'name'
                ));

        $inputs[] =
            array(
                'type' => 'select',
                'label' => $this->l('Durant la semaine écoulée... Vous avez été particulièrement fatigué(e)'),
                'name' => 'sante_fatigue',
                'options' => array(
                    'query' => array(array('id_option' => '', 'name' => 'Non'), array('id_option' => 'fatigue', 'name' => 'Oui')),
                    'id' => 'id_option',
                    'name' => 'name'
                ));

        $inputs[] =
            array(
                'type' => 'select',
                'label' => $this->l('Durant la semaine écoulée... Vous avez eu des problèmes de sommeil'),
                'name' => 'sante_sommeil',
                'options' => array(
                    'query' => array(array('id_option' => '', 'name' => 'Non'), array('id_option' => 'sommeil', 'name' => 'Oui')),
                    'id' => 'id_option',
                    'name' => 'name'
                ));

        $inputs[] =
            array(
                'type' => 'select',
                'label' => $this->l('Durant la semaine écoulée... Vous avez eu un problème de santé et/ou suivi un traitement médical'),
                'name' => 'sante_medical',
                'options' => array(
                    'query' => array(array('id_option' => '', 'name' => 'Non'), array('id_option' => 'medical', 'name' => 'Oui')),
                    'id' => 'id_option',
                    'name' => 'name'
                ));


        $inputs[] = array(
            'type' => 'textarea',
            'label' => $this->l('Autre'),
            'name' => 'sante_autre',
            'suffix' => '....',
            'class' => 'col-xs-3'
        );

        // Activité physique
        $physique = array(
            array('id_option' => '', 'name' => ''),
            array('id_option' => 'Oui_comme_a_votre_habitude', 'name' => 'Oui, comme à votre habitude'),
            array('id_option' => 'Oui_vous_avez_fait_l_effort', 'name' => 'Oui, vous avez fait l\'effort'),
            array('id_option' => 'Pas_vraiment_mais_c_est_en_projet', 'name' => 'Pas vraiment, mais c\'est en projet'),
            array('id_option' => 'Non_vous_etes_définitivement_faché(e)', 'name' => 'Pas vraiment, mais c\'est en projet'),
            array('id_option' => 'Non_vous_ne_pouvez_pas_pratiquer_d_activité_sportive', 'name' => 'Pas vraiment, mais c\'est en projet'),
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Durant la semaine écoulée, avez-vous pratiqué une activité sportive ?'),
            'name' => 'activite_physique',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $physique,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'text',
            'label' => $this->l('Si oui, combien d\'heures dans la semaine (en tout) ?'),
            'name' => 'activite_physique_heure',
            'suffix' => '....',
            'class' => 'col-xs-3'
        );

        // Alimentation
        $alimentation_suivi = array(
            array('id_option' => '', 'name' => ''),
            array('id_option' => 'Oui', 'name' => 'Oui'),
            array('id_option' => 'J_essai_mais_difficile', 'name' => 'J\'essaie, mais c\'est parfois difficile'),
            array('id_option' => 'Non', 'name' => 'Non, je n\'ai pas l\'intention de la suivre'),
        );

        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Cette semaine, avez-vous bien suivi la méthode diététique Ligne&Sens ?'),
            'name' => 'alimentation_suivi',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $alimentation_suivi,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Avez-vous pris vos compléments alimentaires L&Sens régulièrement ?'),
            'name' => 'alimentation_complements_alimentaires',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $oui_non,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Avez-vous bu 1,5 litre d\'eau par jour ?'),
            'name' => 'alimentation_eau_par_jour',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $oui_non,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $alimentation_mange_entre_repas = array(
            array('id_option' => '', 'name' => ''),
            array('id_option' => 'Non', 'name' => 'Non, jamais'),
            array('id_option' => 'Oui_collation', 'name' => 'Oui, vous avez pris des collations (en milieu de matinée ou milieu d\'après-midi)'),
            array('id_option' => 'Oui_grignote', 'name' => 'Oui, vous avez grignoté par-ci par-là (hors collations)'),
        );

        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Avez-vous mangé entre les repas ?'),
            'name' => 'alimentation_mange_entre_repas',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $alimentation_mange_entre_repas,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Avez-vous pris un ou plusieurs repas dans des situations particulières ? (Restaurant, repas de fête, invitation...)'),
            'name' => 'alimentation_repas_particulier',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $oui_non,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $alimentation_respect_methode = array(
            array('id_option' => '', 'name' => ''),
            array('id_option' => 'Oui', 'name' => 'Oui'),
            array('id_option' => 'Non', 'name' => 'Non'),
        );

        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Si oui, avez-vous tout de même respecté la méthode diététique ces jours-là ?'),
            'name' => 'alimentation_respect_methode',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $alimentation_respect_methode,
                'id' => 'id_option',
                'name' => 'name'
            )
        );

        $inputs[] = array(
            'type' => 'textarea',
            'label' => $this->l('Au niveau alimentaire cette semaine, quelles ont été vos sources de plaisir ?'),
            'name' => 'alimentation_plaisir',
            'suffix' => '....',
            'class' => 'col-xs-3'
        );
        $inputs[] = array(
            'type' => 'textarea',
            'label' => $this->l('Au niveau alimentaire cette semaine, quelles ont été vos sources de frustration ?'),
            'name' => 'alimentation_frustration',
            'suffix' => '....',
            'class' => 'col-xs-3'
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Avez-vous eu faim ?'),
            'name' => 'alimentation_faim',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $oui_non,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'textarea',
            'label' => $this->l('Autre'),
            'name' => 'alimentation_faim_autre',
            'suffix' => '....',
            'class' => 'col-xs-3'
        );

        // VOTRE PROGRAMME ET VOUS - SATISFACTION

        $note = array(
            array('id_option' => '', 'name' => ''),
            array('id_option' => '0', 'name' => '0'),
            array('id_option' => '1', 'name' => '1'),
            array('id_option' => '2', 'name' => '2'),
            array('id_option' => '3', 'name' => '3'),
            array('id_option' => '4', 'name' => '4'),
            array('id_option' => '5', 'name' => '5'),
            array('id_option' => '6', 'name' => '6'),
            array('id_option' => '7', 'name' => '7'),
            array('id_option' => '8', 'name' => '8'),
            array('id_option' => '9', 'name' => '9'),
            array('id_option' => '10', 'name' => '10'),
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Aujourd\'hui, quel est votre degré de satisfaction à l\'égard de vos résultats ?'),
            'name' => 'programme_satisfaction_resultat',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $note,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Etes-vous satisfait(e) de ce que VOUS avez accompli cette semaine ?'),
            'name' => 'programme_satisfaction_semaine',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $oui_non,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $inputs[] = array(
            'type' => 'textarea',
            'label' => $this->l('Autre'),
            'name' => 'programme_satisfaction_semaine_autre',
            'suffix' => '....',
            'class' => 'col-xs-3',
        );
        $inputs[] = array(
            'type' => 'textarea',
            'label' => $this->l('Notez ici une résolution que vous décidez de mettre en oeuvre dans la semaine qui vient :'),
            'name' => 'programme_resolution',
            'suffix' => '....',
            'class' => 'col-xs-3'
        );

        // VOTRE PROGRAMME ET VOUS - MOTIVATION

        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Aujourd\'hui, quel est votre degré de satisfaction à l\'égard de vos résultats ?'),
            'name' => 'motivation',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $note,
                'id' => 'id_option',
                'name' => 'name'
            )
        );
        $motivation_dernier_bilan = array(
            array('id_option' => '', 'name' => ''),
            array('id_option' => 'progression', 'name' => 'en progression'),
            array('id_option' => 'regression', 'name' => 'en régression'),
            array('id_option' => 'egale', 'name' => 'égale'),
        );
        $inputs[] = array(
            'type' => 'select',
            'label' => $this->l('Par rapport à votre dernier bilan, cette motivation est-elle :'),
            'name' => 'motivation_dernier_bilan',
            'suffix' => '....',
            'class' => 'col-xs-3',
            'options' => array(
                'query' => $motivation_dernier_bilan,
                'id' => 'id_option',
                'name' => 'name'
            )
        );

        $this->fields_form = array(
            'legend' => array(
                'title' => Tools::isSubmit('updatecarnet') ? $this->l('Modifier Carnet') : $this->l('Nouveau Carnet'),
                'icon' => 'icon-cogs'
            ),
            'input' => $inputs,
            'submit' => array(
                'title' => Tools::isSubmit('updatecarnet') ? $this->l('Update') : $this->l('Add'),
                'class' => 'btn btn-default pull-right'
            )
        );
        return parent::renderForm();
    }


    public function renderView()
    {
        $this->tpl_view_vars['carnet'] = $this->loadObject();
        $this->tpl_view_vars['inputs_sante'] = $this->module->getInputsSante();
        return parent::renderView();
    }

    private function getContacts()
    {
        $contacts = array(array('id_contact' => '', 'name' => ''));
        $c = Contact::getContacts($this->context->language->id);

        foreach ($c as $key => $name) {
            $contacts[] = array('id_contact' => $name['name'], 'name' => $name['name']);
        }
        return $contacts;
    }

    public function formatDate($param)
    {
        return date('d-m-Y H:i:s', strtotime($param));
    }

    public function postProcess()
    {
        parent::postProcess();
//        ddd($_POST);
    }

}