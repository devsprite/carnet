<?php


class letsenscarnetcarnetsModuleFrontController extends ModuleFrontController
{
    public $auth = false;
    public $confirmation;
    public $display_column_left = false;
    public $display_column_right = false;

    public function initContent()
    {
        parent::initContent();
        $allCarnets = $this->module->getAllCarnets($this->context->customer->id);

//        $this->context->controller->addJS(_PS_MODULE_DIR_ . 'letsenscarnet/views/js/jquery.min.js');
        $this->context->controller->addJS(_PS_MODULE_DIR_ . 'letsenscarnet/views/js/bootstrap.min.js');
        $this->context->controller->addJS(_PS_MODULE_DIR_ . 'letsenscarnet/views/js/jquery.flot.js');
        $this->context->controller->addJS(_PS_MODULE_DIR_ . 'letsenscarnet/views/js/jquery.flot.time.js');
        $this->context->controller->addJS(_PS_MODULE_DIR_ . 'letsenscarnet/views/js/jquery.flot.resize.js');
        $this->context->controller->addJS(_PS_MODULE_DIR_ . 'letsenscarnet/views/js/jquery.flot.spline.min.js');

        $this->context->smarty->assign(array(
            'confirmation' => $this->confirmation,
            'carnets' => $allCarnets,
            'data_poids' => $this->data_poids(),
        ));
        $this->setTemplate('carnets.tpl');
    }

    private function data_poids()
    {
        $allCarnets = $this->module->getAllCarnets($this->context->customer->id);

        $data_poids = '';
        if (sizeof($allCarnets > 1)) {
            $data_poids .= '[' . PHP_EOL;
            foreach ($allCarnets as $carnet) {
                $data_poids .= '[gd(' . date('Y, n, j', strtotime($carnet['date_add'])) . '), ' . (int)$carnet['poids'] . '],' . PHP_EOL;
            }
            $data_poids .= ']';
        }


        return $data_poids;
    }

}