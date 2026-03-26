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
    $cat_image_attr = ['default' => '', 'list' => '', 'mobile' => ''];
    $needs_update = false;
    $new_cached_data = [];

    $use_db_sizes = false;
    if (defined('MODULE_CATEGORIES_MITS_PRODUCTSIMAGEFILENAMES_SAVE_SIZES')
      && MODULE_CATEGORIES_MITS_PRODUCTSIMAGEFILENAMES_SAVE_SIZES == 'true'
      && defined('MODULE_CATEGORIES_MITS_PRODUCTSIMAGEFILENAMES_SAVE_SIZES')
      && MODULE_CATEGORIES_MITS_PRODUCTSIMAGEFILENAMES_SAVE_SIZES == 'true'
    ) {
        $use_db_sizes = true;
    }

    if (!empty($categories['categories_image_sizes']) && $use_db_sizes) {
        $cached_cat_sizes = json_decode($categories['categories_image_sizes'], true);
        foreach ($cached_cat_sizes as $key => $dim) {
            $cat_image_attr[$key] = ' width="' . $dim['w'] . '" height="' . $dim['h'] . '"';
        }
    } else {
        if (isset($image) && $image != '' && is_file(DIR_FS_CATALOG . $image)) {
            $size = getimagesize(DIR_FS_CATALOG . $image);
            if ($size) {
                $cat_image_attr['default'] = ' ' . $size[3];
                $new_cached_data['default'] = ['w' => $size[0], 'h' => $size[1]];
                $needs_update = true;
            }
        }
        if (isset($image_list) && $image_list != '' && is_file(DIR_FS_CATALOG . $image_list)) {
            $size = getimagesize(DIR_FS_CATALOG . $image_list);
            if ($size) {
                $cat_image_attr['list'] = ' ' . $size[3];
                $new_cached_data['list'] = ['w' => $size[0], 'h' => $size[1]];
                $needs_update = true;
            }
        }
        if (isset($image_mobile) && $image_mobile != '' && is_file(DIR_FS_CATALOG . $image_mobile)) {
            $size = getimagesize(DIR_FS_CATALOG . $image_mobile);
            if ($size) {
                $cat_image_attr['mobile'] = ' ' . $size[3];
                $new_cached_data['mobile'] = ['w' => $size[0], 'h' => $size[1]];
                $needs_update = true;
            }
        }

        if ($needs_update && isset($categories['categories_id']) && $use_db_sizes) {
            xtc_db_query("UPDATE " . TABLE_CATEGORIES . " 
                          SET categories_image_sizes = '" . xtc_db_input(json_encode($new_cached_data)) . "' 
                          WHERE categories_id = '" . (int)$categories['categories_id'] . "'");
        }
    }

    $default_smarty->assign('CATEGORIES_IMAGE_SIZE', $cat_image_attr['default']);
    $default_smarty->assign('CATEGORIES_IMAGE_LIST_SIZE', $cat_image_attr['list']);
    $default_smarty->assign('CATEGORIES_IMAGE_MOBILE_SIZE', $cat_image_attr['mobile']);
}
