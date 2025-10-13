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
 * ecodebook module admin settings and defaults
 *
 * @package     local_ecodebookmanager
 * @copyright   2022 Satzweiss.com Print Web Software GmbH, https://www.satzweiss.com/ecodebookmanager
 * @category    admin
 * @author      Satzweis
 * @license     http://satzweiss.com/ecodebookmanager
 */


if ($hassiteconfig) { // needs this condition or there is error on login page
    // 
    if ($ADMIN->fulltree) {
        $ADMIN->add('localplugins', new admin_category('local_ecodebookmanager_category', get_string('modulename', 'local_ecodebookmanager')));

        $settings = new admin_settingpage('local_ecodebookmanager', get_string('modulename', 'local_ecodebookmanager'));

        $ADMIN->add('local_ecodebookmanager_category', $settings);
        
        $settings->add(new admin_setting_configtext('local_ecodebookmanager/host',
        get_string('host', 'local_ecodebookmanager'), get_string('enterhost', 'local_ecodebookmanager'), null, PARAM_NOTAGS, null));
        
        $settings->add(new admin_setting_configtext('local_ecodebookmanager/sharedsecret',
        get_string('sharedsecret', 'local_ecodebookmanager'), get_string('enter_sharedsecret', 'local_ecodebookmanager'), null, PARAM_NOTAGS, null));

        $settings->add(new admin_setting_configtext('local_ecodebookmanager/ordersource',
        get_string('ordersource', 'local_ecodebookmanager'), get_string('enter_ordersource', 'local_ecodebookmanager'), null, PARAM_NOTAGS, null));
        
        $settings->add(new admin_setting_configcheckbox('local_ecodebookmanager/enabled',
            get_string('setting_enable', 'local_ecodebookmanager'), get_string('setting_enable_desc', 'local_ecodebookmanager'), '1'));

        $ADMIN->add('local_ecodebookmanager_category', new admin_externalpage('local_ecodebookmanager_manage', get_string('manage', 'local_ecodebookmanager'),
            $CFG->wwwroot . '/local/ecodebookmanager/manage.php'));
    }
}