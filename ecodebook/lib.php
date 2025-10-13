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
 * Mandatory public API of ecodebook module
 *
 * @package    mod_ecodebook
 * @copyright  2009 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined('MOODLE_INTERNAL') || die;
require_once ($CFG->dirroot.'/course/dnduploadlib.php');
/**
 * List of features supported in ecodebook module
 * @param string $feature FEATURE_xx constant for requested feature
 * @return mixed True if module supports feature, false if not, null if doesn't know
 */
function ecodebook_supports($feature) {
    switch($feature) {
        case FEATURE_MOD_ARCHETYPE:           return MOD_ARCHETYPE_RESOURCE;
        case FEATURE_GROUPS:                  return false;
        case FEATURE_GROUPINGS:               return false;
        case FEATURE_COMPLETION_TRACKS_VIEWS: return true;
        case FEATURE_GRADE_HAS_GRADE:         return false;
        case FEATURE_GRADE_OUTCOMES:          return false;
        case FEATURE_BACKUP_MOODLE2:          return true;
        case FEATURE_SHOW_DESCRIPTION:        return true;

        default: return null;
    }
}

/**
 * This function is used by the reset_course_userdata function in moodlelib.
 * @param $data the data submitted from the reset course.
 * @return array status array
 */
function ecodebook_reset_userdata($data) {

    // Any changes to the list of dates that needs to be rolled should be same during course restore and course reset.
    // See MDL-9367.

    return array();
}

/**
 * List the actions that correspond to a view of this module.
 * This is used by the participation report.
 *
 * Note: This is not used by new logging system. Event with
 *       crud = 'r' and edulevel = LEVEL_PARTICIPATING will
 *       be considered as view action.
 *
 * @return array
 */
function ecodebook_get_view_actions() {
    return array('view', 'view all');
}

/**
 * List the actions that correspond to a post of this module.
 * This is used by the participation report.
 *
 * Note: This is not used by new logging system. Event with
 *       crud = ('c' || 'u' || 'd') and edulevel = LEVEL_PARTICIPATING
 *       will be considered as post action.
 *
 * @return array
 */
function ecodebook_get_post_actions() {
    return array('update', 'add');
}

/**
 * Add ecodebook instance.
 * @param object $data
 * @param object $mform
 * @return int new ecodebook instance id
 */
function ecodebook_add_instance($data, $mform) {
    global $CFG, $DB;
    require_once($CFG->dirroot.'/mod/ecodebook/locallib.php');
    $data->id = $DB->insert_record('ecodebook', $data);

    $completiontimeexpected = !empty($data->completionexpected) ? $data->completionexpected : null;
    \core_completion\api::update_completion_date_event($data->coursemodule, 'ecodebook', $data->id, $completiontimeexpected);
    return $data->id;
}

/**
 * Update ecodebook instance.
 * @param object $data
 * @param object $mform
 * @return bool true
 */
function ecodebook_update_instance($data, $mform) {
    global $CFG, $DB;

    require_once($CFG->dirroot.'/mod/ecodebook/locallib.php');
    $data->id           = $data->instance;
    $DB->update_record('ecodebook', $data);
    $completiontimeexpected = !empty($data->completionexpected) ? $data->completionexpected : null;
    \core_completion\api::update_completion_date_event($data->coursemodule, 'ecodebook', $data->id, $completiontimeexpected);
    return true;
}

/**
 * Delete ecodebook instance.
 * @param int $id
 * @return bool true
 */
function ecodebook_delete_instance($id) {
    global $DB;

    if (!$ecodebook = $DB->get_record('ecodebook', array('id'=>$id))) {
        return false;
    }

    $cm = get_coursemodule_from_instance('ecodebook', $id);
    \core_completion\api::update_completion_date_event($cm->id, 'ecodebook', $id, null);

    // note: all context files are deleted automatically

    $DB->delete_records('ecodebook', array('id'=>$ecodebook->id));

    return true;
}

/**
 * Given a course_module object, this function returns any
 * "extra" information that may be needed when printing
 * this activity in a course listing.
 *
 * See {@link get_array_of_activities()} in course/lib.php
 *
 * @param object $coursemodule
 * @return cached_cm_info info
 */
function ecodebook_get_coursemodule_info($coursemodule) {
    global $CFG, $DB;
    require_once("$CFG->dirroot/mod/ecodebook/locallib.php");
    $getrecordData = null;
    try
    {
        $getrecordData = $DB->get_record('ecodebook', array('id'=>$coursemodule->instance),
        'id, name, bookid');
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'lib Line 164';
    }
    if (!$ecodebook = $getrecordData) {
        return NULL;
    }

    $info = new cached_cm_info();
    $info->name = $ecodebook->name;

    //note: there should be a way to differentiate links from normal resources
    $info->icon = ecodebook_guess_icon($ecodebook->name, 24);

    $fullurl = "$CFG->wwwroot/mod/ecodebook/view.php?id=$coursemodule->id&amp;redirect=1";
    $info->onclick = "window.open('$fullurl'); return false;";

    return $info;
}

/**
 * Return a list of page types
 * @param string $pagetype current page type
 * @param stdClass $parentcontext Block's parent context
 * @param stdClass $currentcontext Current context of block
 */
function ecodebook_page_type_list($pagetype, $parentcontext, $currentcontext) {
    $module_pagetype = array('mod-ecodebook-*'=>get_string('page-mod-ecodebook-x', 'ecodebook'));
    return $module_pagetype;
}

/**
 * Export ecodebook resource contents
 *
 * @return array of file content
 */
function ecodebook_export_contents($cm, $baseurl) {
    global $CFG, $DB;
    require_once("$CFG->dirroot/mod/ecodebook/locallib.php");
    $contents = array();
    $context = context_module::instance($cm->id);
    $ecodebookrecord  = null;
    $course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);
    try
    {
        $ecodebookrecord = $DB->get_record('ecodebook', array('id'=>$cm->instance), '*', MUST_EXIST);
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'lib Line 212';
    }
    if ($ecodebookrecord)
    {
        $ecodebook = array();
        $ecodebook['type'] = 'ecodebook';
        $ecodebook['filename']     = clean_param(format_string($ecodebookrecord->name), PARAM_FILE);
        $ecodebook['filepath']     = null;
        $ecodebook['filesize']     = 0;
        $ecodebook['fileurl']      = null;
        $ecodebook['timecreated']  = null;
        $ecodebook['timemodified'] = null;
        $ecodebook['sortorder']    = null;
        $ecodebook['userid']       = null;
        $ecodebook['author']       = null;
        $ecodebook['license']      = null;
        $contents[] = $ecodebook;
    }

    return $contents;
}

/**
 * Register the ability to handle drag and drop file uploads
 * @return array containing details of the files / types the mod can handle
 */
function ecodebook_dndupload_register() {
    return array(
        'addtypes' => array(array('identifier'=>'ecodebook','datatransfertypes'=>'text/plain','addmessage'=>get_string('nameforpage', 'moodle'),'namemessage'=>get_string('whatforpage', 'moodle'))),
        'types' => array(array('identifier' => 'ecodebook', 'message' => get_string('createecodebook', 'ecodebook'))
        )
);
}

/**
 * Handle a file that has been uploaded
 * @param object $uploadinfo details of the file / content that has been uploaded
 * @return int instance id of the newly created mod
 */
function ecodebook_dndupload_handle($uploadinfo) {
    // Gather all the required data.
    $data = new stdClass();
    $data->course = $uploadinfo->course->id;
    $data->name = $uploadinfo->displayname;
    $data->url = clean_param($uploadinfo->content, PARAM_URL);
    $data->timemodified = time();
    $data->coursemodule = $uploadinfo->coursemodule;

    // Set the display options to the site defaults.
    $config = get_config('ecodebook');
    $data->popupwidth = $config->popupwidth;
    $data->popupheight = $config->popupheight;
    return ecodebook_add_instance($data, null);
}

/**
 * Mark the activity completed (if required) and trigger the course_module_viewed event.
 *
 * @param  stdClass $ecodebook        ecodebook object
 * @param  stdClass $course     course object
 * @param  stdClass $cm         course module object
 * @param  stdClass $context    context object
 * @since Moodle 3.0
 */
function ecodebook_view($ecodebook, $course, $cm, $context) {

    // Trigger course_module_viewed event.
    $params = array(
        'context' => $context,
        'objectid' => $ecodebook->id
    );

    $event = \mod_ecodebook\event\course_module_viewed::create($params);
    $event->add_record_snapshot('course_modules', $cm);
    $event->add_record_snapshot('course', $course);
    $event->add_record_snapshot('ecodebook', $ecodebook);
    $event->trigger();

    // Completion.
    $completion = new completion_info($course);
    $completion->set_module_viewed($cm);
}

/**
 * Check if the module has any update that affects the current user since a given time.
 *
 * @param  cm_info $cm course module data
 * @param  int $from the time to check updates from
 * @param  array $filter  if we need to check only specific updates
 * @return stdClass an object with the different type of areas indicating if they were updated or not
 * @since Moodle 3.2
 */
function ecodebook_check_updates_since(cm_info $cm, $from, $filter = array()) {
    $updates = course_check_module_updates_since($cm, $from, array('content'), $filter);
    return $updates;
}

