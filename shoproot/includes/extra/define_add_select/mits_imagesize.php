<?php
/**
 * --------------------------------------------------------------
 * File: mits_imagesize.php
 * Date: 26.03.2026
 * Time: 18:23
 *
 * Author: Hetfield
 * Copyright: (c) 2026 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

if ((defined('MODULE_PRODUCT_MITS_IMAGESIZE_STATUS')
    && MODULE_PRODUCT_MITS_IMAGESIZE_STATUS == 'true')
    && defined('MODULE_CATEGORIES_MITS_PRODUCTSIMAGEFILENAMES_STATUS')
    && MODULE_CATEGORIES_MITS_PRODUCTSIMAGEFILENAMES_STATUS == 'true'
    && defined('MODULE_CATEGORIES_MITS_PRODUCTSIMAGEFILENAMES_SAVE_SIZES')
    && MODULE_CATEGORIES_MITS_PRODUCTSIMAGEFILENAMES_SAVE_SIZES == 'true'
) {
    $add_select_product[] = $add_select_search[] = $add_select_default[] = 'p.products_image_sizes';
    $add_select_categories[] = 'c.categories_image_sizes';
}
