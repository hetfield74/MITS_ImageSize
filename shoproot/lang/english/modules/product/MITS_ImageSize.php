<?php
/**
 * --------------------------------------------------------------
 * File: MITS_ImageSize.php
 * Date: 02.03.2023
 * Time: 13:29
 *
 * Author: Hetfield
 * Copyright: (c) 2023 - MerZ IT-SerVice
 * Web: https://www.merz-it-service.de
 * Contact: info@merz-it-service.de
 * --------------------------------------------------------------
 */

defined('MODULE_PRODUCT_MITS_IMAGESIZE_TITLE') or define('MODULE_PRODUCT_MITS_IMAGESIZE_TITLE', 'MITS_ImageSize &copy; by <a href="https://www.merz-it-service.de" target="_blank" style="font-size: unset"><span style="padding:2px;background:#ffe;color:#6a9;font-weight:bold;">Hetfield (MerZ IT-SerVice)</span></a>');
defined('MODULE_PRODUCT_MITS_IMAGESIZE_DESCRIPTION') or define('MODULE_PRODUCT_MITS_IMAGESIZE_DESCRIPTION', '
  <a href="https://www.merz-it-service.de/" target="_blank"><img src="' . DIR_WS_IMAGES . 'merz-it-service.png" border="0" alt="" style="display:block;max-width:100%;height:auto;" /></a>
  <p>Diese Klassenerweiterungen liest die Bildabmessungen der Artikelbilder aus und stellt sie in den Smarty-Variablen {$PRODUCTS_IMAGE_SIZE}, {$module_data.PRODUCTS_IMAGE_SIZE}, {$module_data.PRODUCTS_IMAGE_SIZE_MIDI} usw. zur Verf&uuml;gung.</p> 
  <p>Au&szlig;erdem sind die Gr&ouml;&szlig;en f&uuml;r die Kategorie-Hauptbilder {$CATEGORIES_IMAGE_SIZE} f&uuml;r {$CATEGORIES_IMAGE} in categorie_listing.html und product_listing_v1.html vorhanden.</p>
  <p>Die Abmessungen der Hersteller-Logos sind auf der Artikeldatailseite per {$MANUFACTURER_IMAGE_SIZE} erweiterbar.</p>
  <p>Bei Fragen, Problemen oder W&uuml;nschen zu diesem Modul oder auch zu anderen Anliegen rund um die modified eCommerce Shopsoftware nehmen Sie einfach Kontakt zu uns auf:</p> 
  <div style="text-align:center;"><a style="background:#6a9;color:#444" target="_blank" href="https://www.merz-it-service.de/Kontakt.html" class="button" onclick="this.blur();">Kontaktseite auf MerZ-IT-SerVice.de</strong></a></div>
');

defined('MODULE_PRODUCT_MITS_IMAGESIZE_STATUS_TITLE') or define('MODULE_PRODUCT_MITS_IMAGESIZE_STATUS_TITLE', 'Modul aktivieren?');
defined('MODULE_PRODUCT_MITS_IMAGESIZE_STATUS_DESC') or define('MODULE_PRODUCT_MITS_IMAGESIZE_STATUS_DESC', 'Modul Status');
defined('MODULE_PRODUCT_MITS_IMAGESIZE_SORT_ORDER_TITLE') or define('MODULE_PRODUCT_MITS_IMAGESIZE_SORT_ORDER_TITLE', 'Sortierreihenfolge');
defined('MODULE_PRODUCT_MITS_IMAGESIZE_SORT_ORDER_DESC') or define('MODULE_PRODUCT_MITS_IMAGESIZE_SORT_ORDER_DESC', 'Reihenfolge der Verarbeitung. Kleinste Ziffer wird zuerst ausgef&uuml;hrt.');
