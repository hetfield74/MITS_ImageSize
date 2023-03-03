<?php
/**
 * --------------------------------------------------------------
 * File: mits_categories_image_size.php
 * Date: 02.03.2023
 * Time: 13:29
 *
 * Author: Hetfield
 * Copyright: (c) 2023 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

if ((defined('MODULE_PRODUCT_MITS_IMAGESIZE_STATUS') && MODULE_PRODUCT_MITS_IMAGESIZE_STATUS == 'true')) {
  $image_attr = $image_attr_list = $image_attr_mobile = '';

  if (isset($image) && $image != '') {
    list($image_width, $image_height, $image_type, $image_attr) = getimagesize(DIR_FS_CATALOG . $image);
    $image_attr = ' ' . $image_attr;
  }
  if (isset($image_list) && $image_list != '') {
    list($image_list_width, $image_list_height, $image_list_type, $image_attr_list) = getimagesize(DIR_FS_CATALOG . $image_list);
    $image_attr_list = ' ' . $image_attr_list;
  }
  if (isset($image_mobile) && $image_mobile != '') {
    list($width, $height, $type, $image_attr_mobile) = getimagesize(DIR_FS_CATALOG . $image_mobile);
    $image_attr_mobile = ' ' . $image_attr_mobile;
  }

  $default_smarty->assign('CATEGORIES_IMAGE_SIZE', $image_attr != '' ? $image_attr : '');
  $default_smarty->assign('CATEGORIES_IMAGE_LIST_SIZE', $image_attr_list != '' ? $image_attr_list : '');
  $default_smarty->assign('CATEGORIES_IMAGE_MOBILE_SIZE', $image_attr_mobile != '' ? $image_attr_mobile : '');
}
