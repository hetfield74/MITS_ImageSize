<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ImageDate.php
 * Created by PhpStorm
 * Date: 26.07.2018
 * Time: 11:40
 *
 * Author: Hetfield
 * Copyright: (c) 2018 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 *
 * Released under the GNU General Public License
 * --------------------------------------------------------------
 */

class MITS_ImageSize {

  function __construct() {
    $this->code = 'MITS_ImageSize';
    $this->name = 'MODULE_PRODUCT_' . strtoupper($this->code);
    $this->version = '1.1';
    $this->title = defined($this->name.'_TITLE') ? constant($this->name.'_TITLE') . ' - v' . $this->version : $this->code . ' - v' . $this->version;
    $this->description = defined($this->name.'_DESCRIPTION') ? constant($this->name.'_DESCRIPTION') : '';
    $this->sort_order = defined($this->name . '_SORT_ORDER') ? constant($this->name . '_SORT_ORDER') : 0;
    $this->enabled = defined($this->name . '_STATUS') && constant($this->name . '_STATUS') == 'true' ? true : false;

    $version_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $this->name . "_VERSION'");
    if (xtc_db_num_rows($version_query)) {
      xtc_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $this->version . "' WHERE configuration_key = '" . $this->name . "_VERSION'");
    } elseif (defined($this->name . '_STATUS')) {
      xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())");
    }
  }

  function check() {
    if (!isset($this->_check)) {
      $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $this->name . "_STATUS'");
      $this->_check = xtc_db_num_rows($check_query);
    }
    return $this->_check;
  }

  function keys() {
    defined($this->name . '_STATUS_TITLE') or define($this->name . '_STATUS_TITLE', TEXT_DEFAULT_STATUS_TITLE);
    defined($this->name . '_STATUS_DESC') or define($this->name . '_STATUS_DESC', TEXT_DEFAULT_STATUS_DESC);
    defined($this->name . '_SORT_ORDER_TITLE') or define($this->name . '_SORT_ORDER_TITLE', TEXT_DEFAULT_SORT_ORDER_TITLE);
    defined($this->name . '_SORT_ORDER_DESC') or define($this->name . '_SORT_ORDER_DESC', TEXT_DEFAULT_SORT_ORDER_DESC);

    return array(
      $this->name . '_STATUS',
      $this->name . '_SORT_ORDER',
    );
  }

  function install() {
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_STATUS', 'true', 6, 1,'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" . $this->name . "_SORT_ORDER', '100', 6, 2, now())");
    xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())");
  }

  function remove() {
    xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE '" . $this->name . "_%'");
  }

  function buildDataArray($productData, $array, $image='thumbnail') {
    global $product, $PHP_SELF;

    $img_attr = '';
    if (isset($array['products_image']) && $array['products_image'] != '') {
      $products_image = $product->productImage($array['products_image'], $image);
      $p_img = substr($products_image, strlen(DIR_WS_BASE));
      list($width, $height, $type, $img_attr) = getimagesize(DIR_FS_CATALOG . $p_img);
      $img_attr = ' ' . $img_attr;
    }

    $img_attr_midi = '';
    if (isset($array['products_image']) && $array['products_image'] != '' && $image == 'thumbnail') {
      $products_image_midi = $product->productImage($array['products_image'], 'midi');
      $p_img_midi = substr($products_image_midi, strlen(DIR_WS_BASE));
      list($width, $height, $type, $img_attr_midi) = getimagesize(DIR_FS_CATALOG . $p_img_midi);
      $img_attr_midi = ' ' . $img_attr_midi;
    }

    $productData['PRODUCTS_IMAGE_SIZE_MIDI'] = $img_attr_midi;
    $productData['PRODUCTS_IMAGE_SIZE'] = $img_attr;

    return $productData;
  }

}
