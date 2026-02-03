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

$modulname = strtoupper("mits_imagesize");

$lang_array = array(
  'MODULE_PRODUCT_' . $modulname . '_TITLE'       => 'MITS_ImageSize &copy; by <a href="https://www.merz-it-service.de" target="_blank" style="font-size: unset"><span style="padding:2px;background:#ffe;color:#6a9;font-weight:bold;">Hetfield (MerZ IT-SerVice)</span></a>',
  'MODULE_PRODUCT_' . $modulname . '_DESCRIPTION' => '
    <a href="https://www.merz-it-service.de/" target="_blank">
      <img src="' . (ENABLE_SSL === true ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG . DIR_WS_IMAGES . 'merz-it-service.png" border="0" alt="MerZ IT-SerVice" style="display:block;max-width:100%;height:auto;" />
    </a><br />
    <p>Diese Klassenerweiterungen liest die Bildabmessungen der Artikelbilder aus und stellt sie in den Smarty-Variablen {$PRODUCTS_IMAGE_SIZE}, {$module_data.PRODUCTS_IMAGE_SIZE}, {$module_data.PRODUCTS_IMAGE_SIZE_MIDI} usw. zur Verf&uuml;gung.</p> 
    <p>Au&szlig;erdem sind die Gr&ouml;&szlig;en f&uuml;r die Kategorie-Hauptbilder {$CATEGORIES_IMAGE_SIZE} f&uuml;r {$CATEGORIES_IMAGE} in categorie_listing.html und product_listing_v1.html vorhanden.</p>
    <p>Die Abmessungen der Hersteller-Logos sind auf der Artikeldatailseite per {$MANUFACTURER_IMAGE_SIZE} erweiterbar.</p>
    <div style="text-align:center;">
      <small>Nur auf Github gibt es immer die aktuellste Version des Moduls!</small><br />
      <a style="background:#6a9;color:#444" target="_blank" href="https://github.com/hetfield74/MITS_ImageSize" class="button" onclick="this.blur();">MITS_ImageSize on Github</a>
    </div>
    <p>Bei Fragen, Problemen oder W&uuml;nschen zu diesem Modul oder auch zu anderen Anliegen rund um die modified eCommerce Shopsoftware nehmen Sie einfach Kontakt zu uns auf:</p> 
    <div style="text-align:center;"><a style="background:#6a9;color:#444" target="_blank" href="https://www.merz-it-service.de/Kontakt.html" class="button" onclick="this.blur();">Kontaktseite auf MerZ-IT-SerVice.de</strong></a></div>
',
  'MODULE_PRODUCT_' . $modulname . '_STATUS_TITLE'           => 'Modul aktivieren?',
  'MODULE_PRODUCT_' . $modulname . '_STATUS_DESC'            => 'Modul Status',
  'MODULE_PRODUCT_' . $modulname . '_SORT_ORDER_TITLE'       => 'Sortierreihenfolge',
  'MODULE_PRODUCT_' . $modulname . '_SORT_ORDER_DESC'        => 'Reihenfolge der Verarbeitung. Kleinste Ziffer wird zuerst ausgef&uuml;hrt.',
  'MODULE_PRODUCT_' . $modulname . '_UPDATE_AVAILABLE_TITLE' => ' <span style="font-weight:bold;color:#900;background:#ff6;padding:2px;border:1px solid #900;">Bitte Modulaktualisierung durchf&uuml;hren!</span>',
  'MODULE_PRODUCT_' . $modulname . '_UPDATE_AVAILABLE_DESC'  => '',
  'MODULE_PRODUCT_' . $modulname . '_UPDATE_FINISHED'        => 'Das Modul MITS_ImageSize wurde aktualisiert.',
  'MODULE_PRODUCT_' . $modulname . '_UPDATE_ERROR'           => 'Fehler',
  'MODULE_PRODUCT_' . $modulname . '_UPDATE_MODUL'           => 'Modul aktualisieren',
  'MODULE_PRODUCT_' . $modulname . '_DELETE_MODUL'           => 'MITS_ImageSize komplett vom Server entfernen',
  'MODULE_PRODUCT_' . $modulname . '_CONFIRM_DELETE_MODUL'   => 'M&ouml;chten sie das Modul MITS_ImageSize mit allen Dateien wirklich vom Server l&ouml;schen?',
  'MODULE_PRODUCT_' . $modulname . '_DELETE_FINISHED'        => 'Das Modul MITS_ImageSize wurde vom Server gel&ouml;scht.',
);

foreach ($lang_array as $key => $val) {
    defined($key) || define($key, $val);
}
