<?php
// This file is part of Moodle Course Rollover Plugin
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
// along with Moodle.  If not, see <http://satzweiss.com/local_ecodebookmanager/licenses/>.

/**
 * @package     local_ecodebookmanager
 * @author      Imad Othman
 * @license     http://satzweiss.com/local_ecodebookmanager
 */

require_once(__DIR__ . '/../../config.php');

global $DB;
global $CFG;
global $CFG;
require_login();
$context = context_system::instance();
require_capability('local/ecodebookmanager:managebooks', $context);

$PAGE->set_url(new moodle_url('/local/ecodebookmanager/manage.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('manage_books', 'local_ecodebookmanager'));
$PAGE->set_heading(get_string('manage_books', 'local_ecodebookmanager'));
$PAGE->requires->js_call_amd('local_ecodebookmanager/confirm');
$PAGE->requires->js('/local/ecodebookmanager/javascript/main.js');
$books = $DB->get_records('local_ecodebookmanager', null, 'id');

echo $OUTPUT->header();
$templatecontext = (object)[
    'books' => array_values($books),
    'editurl' => new moodle_url('/local/ecodebookmanager/edit.php'),
    'imageone' => '/local/ecodebookmanager/images/bookicon.png',
    'editbook' => get_string('editbook', 'local_ecodebookmanager'),
    'deletebook' => get_string('deletebook', 'local_ecodebookmanager'),
    'createbook' => get_string('createbook', 'local_ecodebookmanager'),
    'listofbooks' => get_string('listofbooks', 'local_ecodebookmanager'),
    'control' => get_string('control', 'local_ecodebookmanager'),
    'host' => get_string('host', 'local_ecodebookmanager'),
    'sc' => get_string('ordersource', 'local_ecodebookmanager'),
    'shs' => get_string('sharedsecret', 'local_ecodebookmanager'),
    'hostvalue' => get_config('local_ecodebookmanager', 'host'),
    'scvalue' => get_config('local_ecodebookmanager', 'ordersource'),
    'shsvalue' => get_config('local_ecodebookmanager', 'sharedsecret'),
    'saveCchanges' => get_string('saveCchanges', 'local_ecodebookmanager'),
    'statusyes' => get_string('yes', 'local_ecodebookmanager'),
    'statusno' => get_string('no', 'local_ecodebookmanager'),
    'messageyes' => get_string('messageyes', 'local_ecodebookmanager'),
    'messageno' => get_string('messageno', 'local_ecodebookmanager'),
];

echo $OUTPUT->render_from_template('local_ecodebookmanager/manage', $templatecontext);

echo $OUTPUT->footer();
