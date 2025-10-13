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
 * ecodebook module main user interface
 *
 * @package    mod_ecodebook
 * @copyright  2009 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require('../../config.php');
require_once("$CFG->dirroot/mod/ecodebook/lib.php");
require_once("$CFG->dirroot/mod/ecodebook/locallib.php");
require_once($CFG->libdir . '/completionlib.php');

$id       = optional_param('id', 0, PARAM_INT);        // Course module ID
$u        = optional_param('u', 0, PARAM_INT);         // book instance id
$redirect = optional_param('redirect', 0, PARAM_BOOL);
$forceview = optional_param('forceview', 0, PARAM_BOOL);
$ecodebook = null;
if ($u) {  // Two ways to specify the module
    try
    {
        $ecodebook = $DB->get_record('ecodebook', array('id'=>$u), '*', MUST_EXIST);
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'View Line 44';
    }
    if ($ecodebook)
    {
        $cm = get_coursemodule_from_instance('ecodebook', $ecodebook->id, $ecodebook->course, false, MUST_EXIST);
    }

} else {
    try
    {
        $cm = get_coursemodule_from_id('ecodebook', $id, 0, false, MUST_EXIST);
        $ecodebook = $DB->get_record('ecodebook', array('id'=>$cm->instance), '*', MUST_EXIST);
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'View Line 60';
    }
}

$course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);

require_course_login($course, true, $cm);
$context = context_module::instance($cm->id);
require_capability('mod/ecodebook:view', $context);

// Completion and trigger events.
if ($ecodebook)
{
    ecodebook_view($ecodebook, $course, $cm, $context);
    $PAGE->set_url('/mod/ecodebook/view.php', array('id' => $cm->id));
    ecodebook_print_workaround($ecodebook, $cm, $course);
}



