<?php
if (!defined('_PS_VERSION_'))
    exit;

function upgrade_module_1_0_1($object, $install = false)
{
    $sql = 'ALTER TABLE `' . _DB_PREFIX_ . $object->tableName . '`
     ADD COLUMN `inputs_sante` VARCHAR(255) NULL
     ';

    if(!Db::getInstance()->execute($sql)) {
        return false;
    }

    return true;
}