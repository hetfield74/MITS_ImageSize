<?php
/**
 * --------------------------------------------------------------
 * File: mits_manufacturers_image_size.php
 * Date: 03.03.2023
 * Time: 17:26
 *
 * Author: Hetfield
 * Copyright: (c) 2023 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

if ((defined('MODULE_PRODUCT_MITS_IMAGESIZE_STATUS') && MODULE_PRODUCT_MITS_IMAGESIZE_STATUS == 'true')) {
    $manufacturers_image_attr = '';
    if (isset($manufacturer['manufacturers_image']) && $manufacturer['manufacturers_image'] != '') {
        $manufacturers_image = $main->getImage($manufacturer['manufacturers_image'], 'manufacturers/', MANUFACTURER_IMAGE_SHOW_NO_IMAGE);

        $info_smarty->assign('MANUFACTURER_IMAGE', (($manufacturers_image != '') ? DIR_WS_BASE . $manufacturers_image : ''));
        if (is_file(DIR_FS_CATALOG . $manufacturers_image)) {
            list($width, $height, $type, $manufacturers_image_attr) = getimagesize(DIR_FS_CATALOG . $manufacturers_image);
            $manufacturers_image_attr = ' ' . $manufacturers_image_attr;
        }
    }

    $info_smarty->assign('MANUFACTURER_IMAGE_SIZE', $manufacturers_image_attr != '' ? $manufacturers_image_attr : '');
}