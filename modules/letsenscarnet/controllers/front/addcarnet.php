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
            'customer_name' => $customer->lastname . ' ' . $customer->firstname,
            'name_contacts' => $this->getContacts(),
            'last_carnet' => $lastCarnet,
            'inputs_sante' => $this->module->getInputsSante()
        ));
        $this->setTemplate('addcarnet.tpl');
    }

    public function postProcess()
    {
        if (Tools::isSubmit('submitCarnet')) {
            if (Tools::getValue('name_contact')) {
                $this->addCarnet();
            }
        } elseif (Tools::isSubmit('updateCarnet')) {
            $id_carnet = (int)Tools::getValue('id_carnet');

            if ($this->isCarnetCustomer($id_carnet)) {
                $this->updateCarnet($id_carnet);
            } else {
                $this->errors[] = $this->module->l('Ce carnet ne vous appartient pas.');
            }
        } elseif (Tools::isSubmit('id_carnet')) {
            $id_carnet = (int)Tools::getValue('id_carnet');

            if ($this->isCarnetCustomer($id_carnet)) {
                $this->displayCarnet($id_carnet);
            } else {
                $this->errors[] = $this->module->l('Ce carnet ne vous appartient pas.');
            }

        }
    }

    private function updateCarnet($id_carnet)
    {
        $this->addCarnet($id_carnet);
    }


    private function displayCarnet($id_carnet)
    {
        $carnet = $this->module->getCarnet($id_carnet, (int)$this->context->customer->id);

        $_POST = $carnet;
        $_POST['inputs_sante'] = explode(',', $_POST['inputs_sante']);
        $_POST['name_contact'] = $carnet['id_contact'];

//        ddd($_POST);
    }

    private function addCarnet($id_carnet = null)
    {
        $customer = new Customer();
        $data = array();
        $data_pre = array();
        $message = '';

        if (Tools::getValue('name_contact')) {

            $contact = $this->getEmployeeName(Tools::getValue('name_contact'));

            $data_pre = $this->module->getLastCarnet($this->context->customer->id);
            $customer = New Customer($this->context->customer->id);
            $date_form = Tools::getValue('date_form');

            if ($id_carnet) {
                $data['date_add'] = Tools::getValue('date_form');
            } else {
                $data['date_add'] = date('Y-m-d H:i:s');
            }

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

            if (Tools::getValue('inputs_sante')) {
                $data['inputs_sante'] = implode(',', Tools::getValue('inputs_sante'));
            } else {
                $data['inputs_sante'] = '';
            };
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

            if (empty($data['taille']) || !Validate::isFloat($data['taille'])) {
                $this->errors['taille'] = $this->helperError($this->module->l('Erreur champ taille'));
            }

            if (empty($data['hanches']) || !Validate::isFloat($data['hanches'])) {
                $this->errors['hanches'] = $this->helperError($this->module->l('Erreur champ hanches'));
            }

            if (empty($data['cuisse']) || !Validate::isFloat($data['cuisse'])) {
                $this->errors['cuisse'] = $this->helperError($this->module->l('Erreur champ cuisse'));
            }

            $message = 'Nouveau carnet de suivi, rempli par ' . $data['customer_name'];
        } else {
            $this->errors['contact'] = $this->helperError($this->module->l('Erreur'));
        }

//            if ($data_pre['date_add'] >= $date_form) {
//                $this->errors[] = Tools::displayError('Vous avez déjà enregistré un carnet de suivi aujourd\'hui.');
//            }

        if (!$this->errors) {

            if ($id_carnet) {
                if (!Db::getInstance()->update($this->module->tableName, $data, 'id_carnet =' . $id_carnet)) {
                    $this->errors[] = Tools::displayError('Erreur lors de la mise à jour du carnet.');
                }
            } else {
                if (!Db::getInstance()->insert($this->module->tableName, $data)) {
                    $this->errors[] = Tools::displayError('Erreur : veuillez recommencer');
                }
            }
            if (!$this->errors) {
                $mailCarnet = new MailCarnetClass($data, $data_pre, $this->module->getInputsSante());
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

    /**
     * Est-ce que le carnet appartient au client
     * @param $id_carnet
     * @return bool
     */
    private function isCarnetCustomer($id_carnet)
    {
        $id_customer = (int)$this->context->customer->id;
        $sql = 'SELECT id_customer FROM ' . _DB_PREFIX_ . 'carnet WHERE id_carnet = ' . $id_carnet;
        $carnet_id_customer = Db::getInstance()->getValue($sql);

        if ($id_customer == $carnet_id_customer) {
            return true;
        }
        return false;
    }

}