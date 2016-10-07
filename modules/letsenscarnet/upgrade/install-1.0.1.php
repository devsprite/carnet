<?php
if (!defined('_PS_VERSION_'))
    exit;

function upgrade_module_1_0_1($object, $install = false)
{
    if (!addColumn($object) or
        !convertRecords($object) or
        !removeColumn($object)
    ) {
        return false;
    }

    return true;
}

function addColumn($object)
{
    $sql = 'ALTER TABLE `' . _DB_PREFIX_ . $object->tableName . '`
     ADD COLUMN `inputs_sante` VARCHAR(255) NULL AFTER `cuisse_differrence`,
     ADD COLUMN `hauteur_customer` DECIMAL(5,2) NULL AFTER `motivation_dernier_bilan`,
     MODIFY `taille` DECIMAL (5,2) NULL,
     MODIFY `taille_differrence` DECIMAL (5,2) NULL,
     MODIFY `hanches` DECIMAL (5,2) NULL,
     MODIFY `hanches_differrence` DECIMAL (5,2) NULL,
     MODIFY `cuisse` DECIMAL (5,2) NULL,
     MODIFY `cuisse_differrence`  DECIMAL (5,2) NULL    
     ';

    if (!Db::getInstance()->execute($sql)) {
        return false;
    }

    return true;
}

function convertRecords($object)
{
    $sql = 'SELECT `id_carnet`, `sante_digestif`, `sante_transit`, `sante_stress`, `sante_fatigue`, `sante_sommeil`, 
    `sante_medical` FROM ' . _DB_PREFIX_ . $object->tableName;

    if ($result = DB::getInstance()->executeS($sql)) {
        foreach ($result as $row) {
            $inputs_sante = '';
            $inputs_sante .= ($row['sante_digestif']) ? '0,' : '';
            $inputs_sante .= ($row['sante_transit']) ? '1,' : '';
            $inputs_sante .= ($row['sante_stress']) ? '2,' : '';
            $inputs_sante .= ($row['sante_fatigue']) ? '3,' : '';
            $inputs_sante .= ($row['sante_sommeil']) ? '4,' : '';
            $inputs_sante .= ($row['sante_medical']) ? '5,' : '';
            $inputs_sante = substr($inputs_sante, 0, -1);

            if (!DB::getInstance()->update($object->tableName, array('inputs_sante' => $inputs_sante), 'id_carnet = ' . $row['id_carnet'])) {
                return false;
            }
        }
    }

    return true;
}

function removeColumn($object)
{
    $sql = 'ALTER TABLE ' . _DB_PREFIX_ . $object->tableName . ' 
    DROP COLUMN `sante_digestif`,
    DROP COLUMN `sante_transit`,
    DROP COLUMN `sante_stress`,
    DROP COLUMN `sante_fatigue`,
    DROP COLUMN `sante_sommeil`,
    DROP COLUMN `sante_medical`
    ';

    if (!Db::getInstance()->execute($sql)) {
        return false;
    }

    return true;
}