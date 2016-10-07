<?php


class letsenscarnetcarnetModuleFrontController extends ModuleFrontController
{
    public $auth = false;
    public $confirmation;

    public function initContent()
    {
        parent::initContent();

        $carnet = '';
        if (Tools::getValue('id_carnet')) {
            $id_carnet = Tools::getValue('id_carnet');
            $carnet = $this->module->getCarnet($id_carnet, $this->context->customer->id);
        }

        $this->context->smarty->assign(array(
            'carnet' => $carnet,
            'inputs_sante' => $this->module->formatInputsSante($carnet['inputs_sante']),
            'confirmation' => $this->confirmation
        ));
        $this->setTemplate('carnet.tpl');
    }

    public function postProcess()
    {
        if (Tools::isSubmit('delete')) {
            $id_carnet = (int)Tools::getValue('delete');

            if ($this->isCarnetCustomer($id_carnet)) {
//                Db::getInstance()->delete(_DB_PREFIX_ . 'carnet', 'id_carnet=' . $id_carnet)
                if (true) {
                    $this->confirmation = $this->module->l('Carnet supprimé.');
                } else {
                    $this->errors[] = $this->module->l('Erreur lors de la suppression de votre carnet.');
                }
            } else {
                $this->errors[] = $this->module->l('Erreur lors de la suppression de votre carnet.');
            }

        } elseif (Tools::isSubmit('update')) {
            $id_carnet = (int)Tools::getValue('update');

            if ($this->isCarnetCustomer($id_carnet)) {
                Tools::redirectLink($this->context->link
                    ->getModuleLink('letsenscarnet', 'addcarnet', array('id_carnet' => $id_carnet)));
            } else {
                $this->errors[] = $this->module->l('Ce carnet ne vous appartient pas.');
            }
        }
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
