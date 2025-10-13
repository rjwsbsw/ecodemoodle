<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'ecodebook', language 'de', branch 'MOODLE_20_STABLE'
 *
 * @package    mod_ecodebook
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['displayselect'] = 'Anzeige';
$string['displayselect_help'] = 'Diese Einstellung bestimmt zusammen mit dem EcodeBook-Dateityp und der Frage, ob der Browser das Einbetten zulässt, wie das EcodeBook angezeigt wird. Mögliche Optionen sind:

* Automatic - The best display option for the URL is selected automatically
* Embed - The URL is displayed within the page below the navigation bar together with the EcodeBook description and any blocks
* Open - Only the EcodeBook is displayed in the browser window
* In pop-up - The EcodeBook is displayed in a new browser window without menus or an address bar
* In frame - The EcodeBook is displayed within a frame below the navigation bar and EcodeBook description
* New window - The EcodeBook is displayed in a new browser window with menus and an address bar';
$string['invalidstoredecodebook'] = 'Diese Ressource kann nicht angezeigt werden, EcodeBook ist ungültig.';
$string['framesize'] = 'Höhe des Rahmens';
$string['configframesize'] = 'Wenn eine Webseite oder eine hochgeladene Datei innerhalb eines Rahmens angezeigt wird, ist dieser Wert die Höhe (in Pixel) des oberen Rahmens (der die Navigation enthält).';
$string['configsecretphrase'] = 'Diese "secret phrase" wird verwendet, um einen verschlüsselten Codewert zu erzeugen, der als Parameter an Server gesendet werden kann.  Der verschlüsselte Code wird durch einen md5-Wert der aktuellen Benutzer-IP-Adresse erzeugt. d.h. code = md5(IP.secretphrase). Bitte beachten Sie, dass dies nicht absolut sicher ist, da sich die IP-Adresse ändern kann und oft von verschiedenen Computern gemeinsam genutzt wird.';
$string['configrolesinparams'] = 'Aktivieren Sie diese Option, wenn Sie lokalisierte Rollennamen in die Liste der verfügbaren Parametervariablen aufnehmen möchten.';
$string['rolesinparams'] = 'Rollennamen in Parameter einbeziehen';
$string['configdisplayoptions'] = 'Wählen Sie alle Optionen aus, die verfügbar sein sollen, bestehende Einstellungen werden nicht geändert. Halten Sie die STRG-Taste gedrückt, um mehrere Felder auszuwählen.';
$string['printintroexplain'] = 'EcodeBook-Beschreibung unter dem Inhalt anzeigen? Bei einigen Anzeigetypen wird die Beschreibung nicht angezeigt, auch wenn sie aktiviert ist.';
$string['printintro'] = 'EcodeBook-Beschreibung anzeigen';
$string['popupheight'] = 'Pop-up Höhe (in Pixel)';
$string['popupheightexplain'] = 'Gibt die Standardhöhe von Popup-Fenstern an.';
$string['popupwidth'] = 'Pop-up Breite (in Pixel)';
$string['popupwidthexplain'] = 'Specifies default width of popup windows.';
$string['chooseavariable'] = 'Wählen Sie eine Variable';
$string['chooseabook'] = 'Wählen Sie ein Buch';
$string['modulename'] = 'EcodeBook';
$string['modulename_help'] = 'Das EcodeBook-Modul ermöglicht es einem Lehrer, eine Instanz eines Buches aus einer externen oder internen Quelle bereitzustellen.';
$string['modulename_link'] = 'mod/ecodebook/view';
$string['modulenameplural'] = 'Bücher';
$string['search:activity'] = 'EcodeBook';
$string['serverurl'] = 'Server EcodeBook';
$string['ecodebook:addinstance'] = 'Fügen Sie eine neue EcodeBook Ressource hinzu';
$string['ecodebook:view'] = 'Buchansicht';
$string['clicktoopen'] = '{$a}';
$string['page-mod-url-x'] = 'Jede EcodeBook Modulseite';
$string['parameterinfo'] = '&amp;parameter=value';
$string['parabookinfo'] = 'Wählen Sie das Buch, das Sie hinzufügen wollen';
$string['parametersheader'] = 'Buch URL Parameter';
$string['parametersheader_help'] = 'Bitte geben Sie die Parameter zur Definition des Magic Link an';
$string['pluginadministration'] = 'EcodeBook module administration';
$string['url'] = 'Buch URL';
$string['invalidurl'] = 'Die eingegebene URL ist ungültig';
$string['ecodebook:manageecodebook'] = 'EcodeBook verwalten';
$string['manage_ecodebook'] = 'EcodeBook verwalten';
$string['delete_book'] = 'Ein Buch löschen';
$string['delete_book_confirm'] = 'Sind Sie sicher, dass Sie dieses Buch löschen wollen?';
$string['delete_book_failed'] = 'Das Buch konnte nicht gelöscht werden!';
$string['created_form'] = 'Ein Buch wurde erstellt, Buchtitel->  ';
$string['booktitle'] = 'Titel';
$string['cancelled_form'] = 'Sie haben das Buchformular abgebrochen';
$string['updated_form'] = 'Die Buchangaben wurden geändert, Buchtitel-> ';
$string['setting_enable'] = 'Aktivieren';
$string['setting_enable_desc'] = 'Deaktivieren, damit keine Bücher aus diesem Plugin angezeigt werden';
$string['manage'] = 'EcodeBook verwalten';
$string['contentheader'] = 'Inhalt';
$string['createurl'] = 'Eine URL erstellen';
$string['createecodebook'] = 'EcodeBook erstellen';
$string['displayoptions'] = 'Verfügbare Anzeigeoptionen';
$string['displayselect'] = 'Display';
$string['externalurl'] = 'Externe URL';
$string['externalecodebook'] = 'Externes EcodeBook';
$string['invalidstoredurl'] = 'Diese Ressource kann nicht angezeigt werden, EcodeBook ist ungültig.';
$string['indicator:cognitivedepth'] = 'EcodeBook kognitiv';
$string['indicator:cognitivedepth_help'] = 'Dieser Indikator basiert auf der vom Schüler erreichten kognitiven Tiefe in einer EcodeBook-Ressource.';
$string['indicator:cognitivedepthdef'] = 'EcodeBook kognitiv';
$string['indicator:cognitivedepthdef_help'] = 'The participant has reached this percentage of the cognitive engagement offered by the EcodeBook resources during this analysis interval (Levels = No view, View)';
$string['indicator:cognitivedepthdef_link'] = 'Learning_analytics_indicators#Cognitive_depth';
$string['indicator:socialbreadth'] = 'EcodeBook social';
$string['indicator:socialbreadth_help'] = 'This indicator is based on the social breadth reached by the student in a EcodeBook resource.';
$string['indicator:socialbreadthdef'] = 'EcodeBook social';
$string['indicator:socialbreadthdef_help'] = 'The participant has reached this percentage of the social engagement offered by the EcodeBook resources during this analysis interval (Levels = No participation, Participant alone)';
$string['indicator:socialbreadthdef_link'] = 'Learning_analytics_indicators#Social_breadth';
$string['page-mod-ecodebook-x'] = 'Jede EcodeBook Modulseite';
$string['pluginname'] = 'EcodeBook';
$string['name'] = 'EcodeBook';
$string['privacy:metadata'] = 'Das EcodeBook Plugin speichert keine persönlichen Daten.';

