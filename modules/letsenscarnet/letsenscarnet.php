<?php

class Letsenscarnet extends Module
{
    protected $errors = array();
    protected $tabName;
    protected $html = '';
    protected $config = array();
    protected $inputs_sante = array(
        array('0', 'Vous avez eu des troubles digestifs'),
        array('1', 'Vous avez eu des problèmes de transit'),
        array('2', 'Vous avez été particulièrement stressé(e)'),
        array('3', 'Vous avez été particulièrement fatigué(e)'),
        array('4', 'Vous avez eu des problèmes de sommeil'),
        array('5', 'Vous avez eu un problème de santé')
    );


    public function __construct()
    {
        if (!defined('_PS_VERSION_')) {
            exit();
        }
        $this->name = 'letsenscarnet';
        $this->author = 'Dominique';
        $this->tab = 'others';
        $this->tabName = 'Carnet de suivi pour L et Sens';
        $this->tableName = 'carnet';
        $this->version = '1.0.1';
        $this->controllers = array('carnet', 'carnets', 'addcarnet');
        $this->need_instance = 0;
        $this->bootstrap = true;
        parent::__construct();

        $this->displayName = $this->l('Carnet de Suivi L et Sens');
        $this->description = $this->l('Module de suivi pour L et Sens');
        $this->confirmUninstall = $this->l('Etes vous sur ?');

    }

    public function install()
    {
        if (!parent::install() or
            !$this->createCarnetDeSuiviTable() or
            !$this->registerHook('displayBackOfficeHeader') or
            !$this->registerHook('displayAdminCustomers') or
            !$this->registerHook('displayCustomerAccount') or
            !$this->createTabs()
        ) {
            return false;
        }
        return true;
    }

    public function uninstall()
    {
        if (!parent::uninstall() or
            !$this->eraseTabs() or
            !$this->removeCarnetDeSuiviTable()
        ) {
            return false;
        }
        return true;
    }

    private function createCarnetDeSuiviTable()
    {
        $sql = 'CREATE TABLE `' . _DB_PREFIX_ . $this->tableName . '` (
            `id_carnet` INT (12) NOT NULL AUTO_INCREMENT,
            `id_customer` INT (12) NOT NULL,
            `customer_name` VARCHAR (255) NOT NULL,
            `id_contact` INT (12) NULL,
            `name_contact` VARCHAR (255) NOT NULL,
            `poids` DECIMAL (5,2) NULL,
            `poids_evolution` VARCHAR (255) NULL,
            `poids_differrence` DECIMAL (4,2) NULL,
            `taille` DECIMAL (5,2) NULL,
            `taille_evolution` VARCHAR (255) NULL,
            `taille_differrence` DECIMAL (5,2) NULL,
            `hanches` DECIMAL (5,2) NULL,
            `hanches_evolution` VARCHAR (255) NULL,
            `hanches_differrence` DECIMAL (5,2) NULL,
            `cuisse` DECIMAL (5,2) NULL,
            `cuisse_evolution` VARCHAR (255) NULL,
            `cuisse_differrence`  DECIMAL (5,2) NULL,
            `inputs_sante` VARCHAR(255) NULL,
            `sante_digestif` VARCHAR (255) NULL,
            `sante_transit` VARCHAR (255) NULL,
            `sante_stress` VARCHAR (255) NULL,
            `sante_fatigue` VARCHAR (255) NULL,
            `sante_sommeil` VARCHAR (255) NULL,
            `sante_medical` VARCHAR (255) NULL,
            `sante_autre` VARCHAR(1000) NULL,
            `activite_physique` VARCHAR (255) NULL,
            `activite_physique_heure` TIME NULL,
            `alimentation_suivi` VARCHAR (255) NULL,
            `alimentation_complements_alimentaires` VARCHAR (255) NULL,
            `alimentation_eau_par_jour` VARCHAR (255) NULL,
            `alimentation_mange_entre_repas` VARCHAR (255) NULL,
            `alimentation_repas_particulier` VARCHAR (255) NULL,
            `alimentation_respect_methode` VARCHAR (255) NULL,
            `alimentation_plaisir` TEXT NULL,
            `alimentation_frustration` TEXT NULL,
            `alimentation_faim` VARCHAR (255) NULL,
            `alimentation_faim_autre` VARCHAR (255) NULL,
            `programme_satisfaction_resultat` INT (12) NULL,
            `programme_satisfaction_semaine` VARCHAR (255) NULL,
            `programme_satisfaction_semaine_autre` VARCHAR (255) NULL,
            `programme_resolution` TEXT NULL,
            `motivation` INT (12) NULL,
            `motivation_dernier_bilan` VARCHAR (255) NULL,
            `date_add` DATETIME NOT NULL,
            `date_upd` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id_carnet`)
        ) ENGINE = ' . _MYSQL_ENGINE_;


        if (!Db::getInstance()->execute($sql)) {
            return false;
        }
        return true;

    }

    private function removeCarnetDeSuiviTable()
    {
        if (!Db::getInstance()->execute('DROP TABLE `' . _DB_PREFIX_ . $this->tableName . '`')) {
            return false;
        }
        return true;
    }

    private function createTabs()
    {
        $tab = new Tab();
        $tab->active = 1;
        $languages = Language::getLanguages(false);
        if (is_array($languages)) {
            foreach ($languages as $language) {
                $tab->name[$language['id_lang']] = $this->displayName;
            }
        }
        $tab->class_name = 'Admin' . ucfirst($this->name);
        $tab->module = $this->name;
        $tab->id_parent = 0;

        return (bool)$tab->add();
    }

    private function eraseTabs()
    {
        $id_tab = (int)Tab::getIdFromClassName('Admin' . ucfirst($this->name));
        if ($id_tab) {
            $tab = new Tab($id_tab);
            $tab->delete();
        }
        return true;
    }

    public function hookDisplayBackOfficeHeader()
    {
        $this->context->controller->addCSS($this->_path . 'views/css/letsenscarnet.css', 'all');

    }

    public function hookDisplayCustomerAccount()
    {
        return $this->display(__FILE__, 'carnetAccount.tpl');
    }

    public function hookDisplayAdminCustomers()
    {
        $id_customer = $this->context->customer->id;
        $name_customer = strtoupper($this->context->customer->lastname) . ' ' . $this->context->customer->firstname;
        $link = $this->context->link->getAdminLink('AdminLetsenscarnet') . '&id_customer=' . $id_customer
            . '&customer_name=' . $name_customer . '&addcarnet';

        $this->smarty->assign(array('link' => $link));
        return $this->display(__FILE__, 'addcarnet.tpl');
    }

    public function getLastCarnet($id_customer)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . $this->tableName . '` WHERE id_customer = ' . pSQL($id_customer)
            . ' ORDER BY date_upd DESC';
        return Db::getInstance()->getRow($sql);
    }

    public function getAllCarnets($id_customer)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . $this->tableName . '` WHERE id_customer = ' . pSQL($id_customer)
            . ' ORDER BY date_upd DESC';
        return Db::getInstance()->executeS($sql);
    }

    public function getAllCarnetsASC($id_customer)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . $this->tableName . '` WHERE id_customer = ' . pSQL($id_customer)
            . ' ORDER BY date_upd ASC';
        return Db::getInstance()->executeS($sql);
    }

    public function getCarnet($id_carnet, $id_customer)
    {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . $this->tableName . '` WHERE id_carnet = ' . pSQL($id_carnet)
            . ' AND id_customer = ' . pSQL($id_customer) . ' ORDER BY date_upd DESC';
        return Db::getInstance()->getRow($sql);
    }

    public function getInputsSante($id = null) {
        if ($id) {
            return $this->inputs_sante[$id];
        }
        return $this->inputs_sante;
    }

    public function formatInputsSante($param)
    {
        if (!$param){
            return false;
        }

        $inputs = array();
        $array_inputs = explode(',', $param);

        foreach ($array_inputs as $input) {
            $inputs[] = $this->inputs_sante[$input][1];
        }
        $inputs_sante = implode('<br>', $inputs);

        return $inputs_sante;
    }
}

