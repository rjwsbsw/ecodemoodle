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
// along with Moodle.  If not, see <http://satzweiss.com/ecodebooks/licenses/>.

/**
 * @package     local_ecodebookmanager
 * @author      Imad Othman
 * @license     http://satzweiss.com/ecodebooks
 */

use local_ecodebookmanager\form\edit;
use local_ecodebookmanager\manager;

require_once(__DIR__ . '/../../config.php');

require_login();
$context = context_system::instance();
require_capability('local/ecodebookmanager:managebooks', $context);

$PAGE->set_url(new moodle_url('/local/ecodebookmanager/edit.php'));
$PAGE->set_context(\context_system::instance());
$PAGE->set_title(get_string('createbook', 'local_ecodebookmanager'));
$PAGE->set_heading(get_string('createbook', 'local_ecodebookmanager'));
$bookidint = optional_param('bookidint', null,PARAM_INT);
if ($bookidint)
{
    $PAGE->set_title(get_string('editbook', 'local_ecodebookmanager'));
    $PAGE->set_heading(get_string('editbook', 'local_ecodebookmanager'));
}

// We want to display our form.
$mform = new edit();

if ($mform->is_cancelled()) {
    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/ecodebookmanager/manage.php', get_string('cancelled_form', 'local_ecodebookmanager'));

} else if ($fromform = $mform->get_data()) {
    $manager = new manager();

    if ($fromform->id) {
        // We are updating an existing book.
        $manager->update_book($fromform->id,$fromform->bookid, $fromform->booktitle,$fromform->ordersource,$fromform->sharedsecret,$fromform->host);
        redirect($CFG->wwwroot . '/local/ecodebookmanager/manage.php', get_string('updated_form', 'local_ecodebookmanager') . $fromform->booktitle);
    }

    $manager->create_book($fromform->bookid, $fromform->booktitle,$fromform->ordersource,$fromform->sharedsecret,$fromform->host);

    // Go back to manage.php page
    redirect($CFG->wwwroot . '/local/ecodebookmanager/manage.php', get_string('created_form', 'local_ecodebookmanager') . $fromform->booktitle);
}

if ($bookidint) {
    // Add extra data to the form.
    global $DB;
    $manager = new manager();
    $book = $manager->get_book($bookidint);
    if (!$book) {
        throw new invalid_parameter_exception('Book not found');
    }
    $mform->set_data($book);
}

echo $OUTPUT->header();
$mform->display();
echo $OUTPUT->footer();
