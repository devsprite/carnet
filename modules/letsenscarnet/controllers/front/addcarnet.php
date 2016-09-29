<?php

require_once(dirname(__FILE__) . '/../../classes/MailCarnetClass.php');

class letsenscarnetaddcarnetModuleFrontController extends ModuleFrontController
{
    public $auth = true;
    public $confirmation;
    public $display_column_left = false;
    public $display_column_right = false;
    public $params;

    public function initContent()
    {
        parent::initContent();
        $customer = New Customer($this->context->customer->id);
        $this->context->controller->addJquery();
        $this->context->controller->addJS(_PS_MODULE_DIR_ . 'letsenscarnet/views/js/carnet.js');
        $lastCarnet = $this->module->getLastCarnet($this->context->customer->id);

        $this->context->smarty->assign(array(
            'confirmation' => $this->confirmation,
            'mails' => $this->params,
            'date_jour' => date('d-m-Y'),
            'customer_name' => $customer->lastname . ' ' . $customer->firstname,
            'name_contacts' => $this->getContacts(),
            'last_carnet' => $lastCarnet
        ));
        $this->setTemplate('addcarnet.tpl');
    }

    public function postProcess()
    {
        $customer = new Customer();
        $data = array();
        $data_pre = array();
        $message = '';


        if (Tools::isSubmit('submitCarnet')) {
            if (Tools::getValue('name_contact')) {

                ddd($_POST);

                $contact = $this->getEmployeeName(Tools::getValue('name_contact'));

                $data_pre = $this->module->getLastCarnet($this->context->customer->id);
                $customer = New Customer($this->context->customer->id);

                $data['id_customer'] = $customer->id;
                $data['customer_name'] = $customer->lastname . ' ' . $customer->firstname;
                $data['name_contact'] = (isset($contact->name[1])) ? $contact->name[1] : '';
                $data['id_contact'] = (isset($contact->id)) ? $contact->id : '';
                $data['poids'] = Tools::getValue('poids');
                $data['poids_evolution'] = (isset($data_pre['poids']))
                    ? $this->evolution(Tools::getValue('poids'), $data_pre['poids'])
                    : '';
                $data['poids_differrence'] = (isset($data_pre['poids']))
                    ? $this->differrence(Tools::getValue('poids'), $data_pre['poids'])
                    : '';
                $data['taille'] = Tools::getValue('taille');
                $data['taille_evolution'] = (isset($data_pre['taille']))
                    ? $this->evolution(Tools::getValue('taille'), $data_pre['taille'])
                    : '';
                $data['taille_differrence'] = (isset($data_pre['taille']))
                    ? $this->differrence(Tools::getValue('taille'), $data_pre['taille'])
                    : '';
                $data['hanches'] = Tools::getValue('hanches');
                $data['hanches_evolution'] = (isset($data_pre['hanches']))
                    ? $this->evolution(Tools::getValue('hanches'), $data_pre['hanches'])
                    : '';
                $data['hanches_differrence'] = (isset($data_pre['hanches']))
                    ? $this->differrence(Tools::getValue('hanches'), $data_pre['hanches'])
                    : '';
                $data['cuisse'] = Tools::getValue('cuisse');
                $data['cuisse_evolution'] = (isset($data_pre['cuisse']))
                    ? $this->evolution(Tools::getValue('cuisse'), $data_pre['cuisse'])
                    : '';
                $data['cuisse_differrence'] = (isset($data_pre['cuisse']))
                    ? $this->differrence(Tools::getValue('cuisse'), $data_pre['cuisse'])
                    : '';
                $data['sante_digestif'] = Tools::getValue('sante_digestif');
                $data['sante_transit'] = Tools::getValue('sante_transit');
                $data['sante_stress'] = Tools::getValue('sante_stress');
                $data['sante_fatigue'] = Tools::getValue('sante_fatigue');
                $data['sante_sommeil'] = Tools::getValue('sante_sommeil');
                $data['sante_medical'] = Tools::getValue('sante_medical');
                $data['sante_autre'] = Tools::getValue('sante_autre');
                $data['activite_physique'] = Tools::getValue('activite_physique');
                $data['activite_physique_heure'] = Tools::getValue('activite_physique_heure');
                $data['alimentation_suivi'] = Tools::getValue('alimentation_suivi');
                $data['alimentation_complements_alimentaires'] = Tools::getValue('alimentation_complements_alimentaires');
                $data['alimentation_eau_par_jour'] = Tools::getValue('alimentation_eau_par_jour');
                $data['alimentation_mange_entre_repas'] = Tools::getValue('alimentation_mange_entre_repas');
                $data['alimentation_repas_particulier'] = Tools::getValue('alimentation_repas_particulier');
                $data['alimentation_respect_methode'] = Tools::getValue('alimentation_respect_methode');
                $data['alimentation_plaisir'] = Tools::getValue('alimentation_plaisir');
                $data['alimentation_frustration'] = Tools::getValue('alimentation_frustration');
                $data['alimentation_faim'] = Tools::getValue('alimentation_faim');
                $data['alimentation_faim_autre'] = Tools::getValue('alimentation_faim_autre');
                $data['programme_satisfaction_resultat'] = Tools::getValue('programme_satisfaction_resultat');
                $data['programme_satisfaction_semaine'] = Tools::getValue('programme_satisfaction_semaine');
                $data['programme_satisfaction_semaine_autre'] = Tools::getValue('programme_satisfaction_semaine_autre');
                $data['programme_resolution'] = Tools::getValue('programme_resolution');
                $data['motivation'] = Tools::getValue('motivation');
                $data['motivation_dernier_bilan'] = Tools::getValue('motivation_dernier_bilan');


                if (empty($data['poids']) || !Validate::isFloat($data['poids'])) {
                    $this->errors['poids'] = $this->helperError($this->module->l('Erreur champ poids'));
                }

                if (empty($data['taille']) || !Validate::isInt($data['taille'])) {
                    $this->errors['taille'] = $this->helperError($this->module->l('Erreur champ taille'));
                }

                if (empty($data['hanches']) || !Validate::isInt($data['hanches'])) {
                    $this->errors['hanches'] = $this->helperError($this->module->l('Erreur champ hanches'));
                }

                if (empty($data['cuisse']) || !Validate::isInt($data['cuisse'])) {
                    $this->errors['cuisse'] = $this->helperError($this->module->l('Erreur champ cuisse'));
                }

                $message = 'Nouveau carnet de suivi, rempli par ' . $data['customer_name'];
            } else {
                $this->errors['contact'] = $this->helperError($this->module->l('Erreur'));
            }

            if (!$this->errors) {
                if (!Db::getInstance()->insert($this->module->tableName, $data)) {
                    $this->errors[] = Tools::displayError('Erreur : veuillez recommencer');
                } else {
                    $mailCarnet = new MailCarnetClass($data, $data_pre);
                    $this->params = $mailCarnet->createMail();

                    Mail::Send($this->context->language->id, 'carnet', 'Votre carnet de suivi',
                        $this->params,
                        $customer->email,
                        $customer->firstname . ' ' . $customer->lastname,
                        Configuration::get('PS_SHOP_EMAIL'),
                        Configuration::get('PS_SHOP_NAME'),
                        null, null, dirname(__FILE__) . '/../../mails/', true);


                    if ($contact->id != 0) {
                        $ct = new CustomerThread();
                        $ct->id_shop = (int)$this->context->shop->id;
                        $ct->id_contact = (int)$contact->id;
                        $ct->id_lang = (int)$this->context->language->id;
                        $ct->email = $contact->email;
                        $ct->status = 'open';
                        $ct->token = Tools::passwdGen(12);
                        $ct->add();

                        if ($ct->id) {
                            $cm = new CustomerMessage();
                            $cm->id_customer_thread = (int)$ct->id;
                            $cm->message = $message;
                            $cm->add();
                        }
                    }

                    $this->confirmation = $this->module->l('Carnet de suivi enregistré.');
                }
            }
        }
    }

    public function setMedia()
    {
        parent::setMedia();
        $this->context->controller->addCSS(_PS_MODULE_DIR_ . '/letsenscarnet/views/css/carnet.css');
    }


    protected function helperError($error)
    {
        return 'alert-danger';
    }

    private function getContacts()
    {
        $contacts = array();
        $c = Contact::getContacts($this->context->language->id);

        foreach ($c as $key => $name) {
            $contacts[] = array('id_contact' => $name['id_contact'], 'name' => $name['name']);
        }
        return $contacts;
    }

    private function getEmployeeName($getValue)
    {
        if (empty($getValue) || $getValue == 0) {
            return false;
        }
        return New Contact((int)$getValue);
    }

    private function evolution($value, $value_pre)
    {
        $val = '';

        if (floatval($value) > floatval($value_pre)) {
            $val = 'augmenté';
        } else if (floatval($value) < floatval($value_pre)) {
            $val = 'diminué';
        } else {
            $val = 'stagné';
        }
        return $val;
    }

    private function differrence($value, $value_pre)
    {
        return floatval($value) - floatval($value_pre);
    }

}