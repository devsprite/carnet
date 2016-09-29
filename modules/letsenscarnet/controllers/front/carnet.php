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
        ));
        $this->setTemplate('carnet.tpl');
    }
}