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

/** Usage:
{foreach name=inner item=picture_data from=$pictureset_box}
  {assign var="img_type" value=$picture_data.IMAGE|upper}
  {assign var="img_size" value="PRODUCTS_`$img_type`_SIZE"}
  <source media="(max-width:{$picture_data.SIZE}px)"
          srcset="{$module_data.PRODUCTS_IMAGE|replace:"thumbnail_images":"`$picture_data.IMAGE`"}"
          {$module_data.$img_size}
  >
{/foreach}
<source srcset="{$module_data.PRODUCTS_IMAGE}"{$module_data.PRODUCTS_IMAGE_SIZE}>
<img src="{$module_data.PRODUCTS_IMAGE}" alt="{$module_data.PRODUCTS_NAME|onlytext}"{$module_data.PRODUCTS_IMAGE_SIZE}>
**/

class MITS_ImageSize
{

    public string $code;
    public string $name;
    public string $version;
    public mixed $sort_order;
    public string $title;
    public string $description;
    public mixed $do_update;
    public bool $enabled;
    private bool $_check;

    function __construct()
    {
        $this->code = 'MITS_ImageSize';
        $this->name = 'MODULE_PRODUCT_' . strtoupper($this->code);
        $this->version = '1.4.1';
        $this->sort_order = defined($this->name . '_SORT_ORDER') ? constant($this->name . '_SORT_ORDER') : 0;
        $this->enabled = defined($this->name . '_STATUS') && (constant($this->name . '_STATUS') == 'true');

        if (defined($this->name . '_VERSION') && $this->version != constant($this->name . '_VERSION')) {
            $this->do_update = (defined($this->name . '_UPDATE_AVAILABLE_TITLE')) ? constant($this->name . '_UPDATE_AVAILABLE_TITLE') : '';
        } else {
            $this->do_update = '';
        }

        $this->title = (defined($this->name . '_TITLE') ? constant($this->name . '_TITLE') : $this->code) . ' - v' . $this->version . $this->do_update;
        $this->description = '';
        if ($this->do_update != '' && isset($_GET['set'])) {
            $this->description .= '<a class="button btnbox but_green" style="text-align:center;" onclick="this.blur();" href="' . xtc_href_link(FILENAME_MODULES, 'set=' . $_GET['set'] . '&module=' . $this->code . '&action=update') . '">' . constant($this->name . '_UPDATE_MODUL') . '</a><br>';
        }
        $this->description .= defined($this->name . '_DESCRIPTION') ? constant($this->name . '_DESCRIPTION') . '<hr style="margin:10px 0">' : '';

        if (!$this->enabled) {
            $this->description .= '<div style="text-align:center;margin:30px 0"><a class="button but_red" style="text-align:center;" onclick="return confirmLink(\'' . constant($this->name . '_CONFIRM_DELETE_MODUL') . '\', \'\' ,this);" href="' . xtc_href_link(FILENAME_MODULES, 'set=product&module=' . $this->code . '&action=custom') . '">' . constant(
                $this->name . '_DELETE_MODUL'
              ) . '</a></div><br>';
        }
    }

    /**
     * @return true
     */
    public function check(): bool
    {
        if (!isset($this->_check)) {
            if (defined($this->name . '_STATUS') && !defined('RUN_MODE_ADMIN')) {
                $this->_check = true;
            } else {
                $check_query = xtc_db_query("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $this->name . "_STATUS'");
                $this->_check = xtc_db_num_rows($check_query);
            }
        }
        return $this->_check;
    }


    /**
     * @return void
     */
    public function update(): void
    {
        global $messageStack;

        xtc_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $this->version . "' WHERE configuration_key = '" . $this->name . "_VERSION'");

        $messageStack->add_session(constant($this->name . '_UPDATE_FINISHED'), 'success');
    }

    /**
     * @return void
     */
    public function custom(): void
    {
        global $messageStack;

        $this->remove();

        $this->removeModulfiles();

        $messageStack->add_session(constant($this->name . '_DELETE_FINISHED'), 'success');
    }

    /**
     * @return string[]
     */
    public function keys(): array
    {
        defined($this->name . '_STATUS_TITLE') || define($this->name . '_STATUS_TITLE', TEXT_DEFAULT_STATUS_TITLE);
        defined($this->name . '_STATUS_DESC') || define($this->name . '_STATUS_DESC', TEXT_DEFAULT_STATUS_DESC);
        defined($this->name . '_SORT_ORDER_TITLE') || define($this->name . '_SORT_ORDER_TITLE', TEXT_DEFAULT_SORT_ORDER_TITLE);
        defined($this->name . '_SORT_ORDER_DESC') || define($this->name . '_SORT_ORDER_DESC', TEXT_DEFAULT_SORT_ORDER_DESC);

        $key = array(
          $this->name . '_STATUS',
          $this->name . '_SORT_ORDER',
        );

        return $key;
    }

    /**
     * @return void
     */
    public function install(): void
    {
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_STATUS', 'true', 6, 1,'xtc_cfg_select_option(array(\'true\', \'false\'), ', now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, date_added) VALUES ('" . $this->name . "_SORT_ORDER', '100', 6, 2, now())");
        xtc_db_query("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_key, configuration_value, configuration_group_id, sort_order, set_function, date_added) VALUES ('" . $this->name . "_VERSION', '" . $this->version . "', 6, 99, NULL, now())");
    }

    public function remove(): void
    {
        xtc_db_query("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key LIKE '" . $this->name . "_%'");
    }

    /**
     * @return void
     */
    protected function removeModulfiles(): void
    {
        $remove_files_array = array(
          DIR_FS_DOCUMENT_ROOT . 'lang/english/modules/product/' . $this->code . '.php',
          DIR_FS_DOCUMENT_ROOT . 'lang/german/modules/product/' . $this->code . '.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/extra/default/categories_smarty/mits_categories_image_size.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/extra/modules/product_info_end/mits_manufacturers_image_size.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/extra/modules/product_listing_begin/mits_categories_image_size.php',
          DIR_FS_DOCUMENT_ROOT . 'includes/modules/product/' . $this->code . '.php',
        );

        foreach ($remove_files_array as $delete_file) {
            if (is_file($delete_file)) {
                unlink($delete_file);
            }
        }

    }

    /**
     * @param $productData
     * @param $array
     * @param string $image
     * @return array
     */
    public function buildDataArray(array $productData, array $array, string $image = 'thumbnail') : array
    {
        global $product, $PHP_SELF;

        $filename = $array['products_image'];
        $types = ['mini', 'thumbnail', 'midi', 'info', 'popup'];
        $image_data = [];

        foreach ($types as $type) {
            $constant_name = 'DIR_WS_' . strtoupper($type) . '_IMAGES';
            $path = defined($constant_name) ? constant($constant_name) : 'images/product_images/' . $type . '_images/';

            $current_name = $filename;

            if (defined('IMAGE_TYPE_EXTENSION') && IMAGE_TYPE_EXTENSION != 'default') {
                $name_extension = substr($filename, 0, strrpos($filename, '.')) . '.' . IMAGE_TYPE_EXTENSION;
                if (is_file(DIR_FS_CATALOG . $path . $name_extension)) {
                    $current_name = $name_extension;
                }
            }

            $full_path = DIR_FS_CATALOG . $path . $current_name;
            if (is_file($full_path)) {
                $size = getimagesize($full_path);
                if ($size) {
                    $image_data[$type] = [
                      'width'  => $size[0],
                      'height' => $size[1],
                      'attr'   => ' ' . $size[3]
                    ];
                    $key_name = 'PRODUCTS_' . strtoupper($type) . '_IMAGES_SIZE';
                    $productData[$key_name] = ' width="' . $size[0] . '" height="' . $size[1] . '"';
                }
            }
        }

        $productData['PRODUCT_IMAGE_DETAILS'] = $image_data;

        if (isset($image_data[$image])) {
            $productData['PRODUCTS_IMAGE_SIZE'] = $image_data[$image]['attr'];
        }
        if (isset($image_data['midi'])) {
            $productData['PRODUCTS_IMAGE_SIZE_MIDI'] = $image_data['midi']['attr'];
        }

        return $productData;
    }

}
