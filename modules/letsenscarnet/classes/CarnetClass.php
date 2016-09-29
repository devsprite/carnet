<?php

class CarnetClass extends ObjectModel
{
    public $id_customer;

    public $id_contact;

    public $customer_name;

    public $name_contact;

    public $poids;

    public $poids_evolution;

    public $poids_differrence;

    public $taille;

    public $taille_evolution;

    public $taille_differrence;

    public $hanches;

    public $hanches_evolution;

    public $hanches_differrence;

    public $cuisse;

    public $cuisse_evolution;

    public $cuisse_differrence;

    public $sante_digestif;

    public $sante_transit;

    public $sante_stress;

    public $sante_fatigue;

    public $sante_sommeil;

    public $sante_medical;

    public $sante_autre;

    public $activite_physique;

    public $activite_physique_heure;

    public $alimentation_suivi;

    public $alimentation_complements_alimentaires;

    public $alimentation_eau_par_jour;

    public $alimentation_mange_entre_repas;

    public $alimentation_repas_particulier;

    public $alimentation_respect_methode;

    public $alimentation_plaisir;

    public $alimentation_frustration;

    public $alimentation_faim;

    public $alimentation_faim_autre;

    public $programme_satisfaction_resultat;

    public $programme_satisfaction_semaine;

    public $programme_satisfaction_semaine_autre;

    public $programme_resolution;

    public $motivation;

    public $motivation_dernier_bilan;

    public $date_add;

    public $date_upd;

    public static $definition = array(
        'table' => 'carnet',
        'primary' => 'id_carnet',
        'fields' => array(
            'id_customer' => array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId', 'required' => true),
            'customer_name' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'required' => true),
            'id_contact' => array('type' => self::TYPE_INT, 'validate' => 'isNullOrUnsignedId'),
            'name_contact' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'required' => true),
            'poids' => array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat', 'required' => true),
            'poids_evolution' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'poids_differrence' => array('type' => self::TYPE_FLOAT, 'validate' => 'isUnsignedFloat'),
            'taille' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => true),
            'taille_evolution' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'taille_differrence' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'size' => 500),
            'hanches' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'size' => 500, 'required' => true),
            'hanches_evolution' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'hanches_differrence' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'size' => 500),
            'cuisse' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'size' => 500, 'required' => true),
            'cuisse_evolution' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'cuisse_differrence' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'size' => 500),
            'sante_digestif' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'sante_transit' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'sante_stress' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'sante_fatigue' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'sante_sommeil' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'sante_medical' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'sante_autre' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 1000),
            'activite_physique' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'activite_physique_heure' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'alimentation_suivi' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'alimentation_complements_alimentaires' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'alimentation_eau_par_jour' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'alimentation_mange_entre_repas' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'alimentation_repas_particulier' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'alimentation_respect_methode' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'alimentation_plaisir' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'alimentation_frustration' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'alimentation_faim' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'alimentation_faim_autre' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'programme_satisfaction_resultat' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'programme_satisfaction_semaine' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'programme_satisfaction_semaine_autre' => array('type' => self::TYPE_STRING, 'validate' => 'isString', 'size' => 500),
            'programme_resolution' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'motivation' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'motivation_dernier_bilan' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDate'),
        ),
    );

    public static function getLastCarnet($id_customer)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'carnet` WHERE id_customer = ' . pSQL($id_customer)
            . ' ORDER BY date_upd DESC';
        return Db::getInstance()->getRow($sql);
    }

}