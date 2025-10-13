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
 * Strings for component 'ecodebook', language 'en', branch 'MOODLE_20_STABLE'
 *
 * @package    mod_ecodebook
 * @copyright  1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['displayselect'] = 'Display';
$string['displayselect_help'] = 'This setting, together with the EcodeBook file type and whether the browser allows embedding, determines how the EcodeBook is displayed. Options may include:

* Automatic - The best display option for the URL is selected automatically
* Embed - The URL is displayed within the page below the navigation bar together with the EcodeBook description and any blocks
* Open - Only the EcodeBook is displayed in the browser window
* In pop-up - The EcodeBook is displayed in a new browser window without menus or an address bar
* In frame - The EcodeBook is displayed within a frame below the navigation bar and EcodeBook description
* New window - The EcodeBook is displayed in a new browser window with menus and an address bar';
$string['invalidstoredecodebook'] = 'Cannot display this resource, ecodebook is invalid.';
$string['framesize'] = 'Frame height';
$string['configframesize'] = 'When a web page or an uploaded file is displayed within a frame, this value is the height (in pixels) of the top frame (which contains the navigation).';
$string['configsecretphrase'] = 'This secret phrase is used to produce encrypted code value that can be sent to some servers as a parameter.  The encrypted code is produced by an md5 value of the current user IP address concatenated with your secret phrase. ie code = md5(IP.secretphrase). Please note that this is not reliable because IP address may change and is often shared by different computers.';
$string['configrolesinparams'] = 'Enable if you want to include localized role names in list of available parameter variables.';
$string['rolesinparams'] = 'Include role names in parameters';
$string['configdisplayoptions'] = 'Select all options that should be available, existing settings are not modified. Hold CTRL key to select multiple fields.';
$string['printintroexplain'] = 'Display EcodeBook description below content? Some display types may not display description even if enabled.';
$string['printintro'] = 'Display EcodeBook description';
$string['popupheight'] = 'Pop-up height (in pixels)';
$string['popupheight'] = 'Pop-up height (in pixels)';
$string['popupheightexplain'] = 'Specifies default height of popup windows.';
$string['popupwidth'] = 'Pop-up width (in pixels)';
$string['popupwidthexplain'] = 'Specifies default width of popup windows.';
$string['chooseavariable'] = 'Choose a variable...';
$string['chooseabook'] = 'Choose a book...';
$string['modulename'] = 'EcodeBook';
$string['modulename_help'] = 'The EcodeBook module enables a teacher to provide an instance of a book from external or internal recourse';
$string['modulename_link'] = 'mod/ecodebook/view';
$string['modulenameplural'] = 'Books';
$string['search:activity'] = 'EcodeBook';
$string['serverurl'] = 'Server EcodeBook';
$string['ecodebook:addinstance'] = 'Add a new ecodebook resource';
$string['ecodebook:view'] = 'View book';
$string['clicktoopen'] = '{$a}';
$string['page-mod-url-x'] = 'Any EcodeBook module page';
$string['parameterinfo'] = '&amp;parameter=value';
$string['parabookinfo'] = 'select the book you want to add';
$string['parametersheader'] = 'Book URL Parameters';
$string['parametersheader_help'] = 'please write the parameters could be used to define a Magic link';
$string['pluginadministration'] = 'EcodeBook module administration';
$string['url'] = 'Book URL';
$string['invalidurl'] = 'Entered URL is invalid';
$string['ecodebook:manageecodebook'] = 'Manage EcodeBook';
$string['manage_ecodebook'] = 'Manage EcodeBook';
$string['delete_book'] = 'Delete a book';
$string['delete_book_confirm'] = 'Are you sure you want to delete the book?';
$string['delete_book_failed'] = 'the book could not be deleted!';
$string['created_form'] = 'You created a book with title ';
$string['booktitle'] = 'Book Title';
$string['cancelled_form'] = 'You cancelled the book form';
$string['updated_form'] = 'You updated a book with title ';
$string['setting_enable'] = 'Enable';
$string['setting_enable_desc'] = 'Disable to stop any books from this plugin being displayed';
$string['manage'] = 'Manage EcodeBook';
$string['contentheader'] = 'Content';
$string['createurl'] = 'Create a URL';
$string['createecodebook'] = 'Create a EcodeBook';
$string['displayoptions'] = 'Available display options';
$string['displayselect'] = 'Display';
$string['externalurl'] = 'External URL';
$string['externalecodebook'] = 'External EcodeBook';
$string['invalidstoredurl'] = 'Cannot display this resource, EcodeBook is invalid.';
$string['indicator:cognitivedepth'] = 'EcodeBook cognitive';
$string['indicator:cognitivedepth_help'] = 'This indicator is based on the cognitive depth reached by the student in a EcodeBook resource.';
$string['indicator:cognitivedepthdef'] = 'EcodeBook cognitive';
$string['indicator:cognitivedepthdef_help'] = 'The participant has reached this percentage of the cognitive engagement offered by the EcodeBook resources during this analysis interval (Levels = No view, View)';
$string['indicator:cognitivedepthdef_link'] = 'Learning_analytics_indicators#Cognitive_depth';
$string['indicator:socialbreadth'] = 'EcodeBook social';
$string['indicator:socialbreadth_help'] = 'This indicator is based on the social breadth reached by the student in a EcodeBook resource.';
$string['indicator:socialbreadthdef'] = 'EcodeBook social';
$string['indicator:socialbreadthdef_help'] = 'The participant has reached this percentage of the social engagement offered by the EcodeBook resources during this analysis interval (Levels = No participation, Participant alone)';
$string['indicator:socialbreadthdef_link'] = 'Learning_analytics_indicators#Social_breadth';
$string['page-mod-ecodebook-x'] = 'Any EcodeBook module page';
$string['pluginname'] = 'EcodeBook';
$string['name'] = 'EcodeBook';
$string['privacy:metadata'] = 'The EcodeBook resource plugin does not store any personal data.';

