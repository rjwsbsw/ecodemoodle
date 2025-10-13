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
 * Private ecodebook module utility functions
 *
 * @package    mod_ecodebook
 * @copyright  2009 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once("$CFG->libdir/filelib.php");
require_once("$CFG->libdir/resourcelib.php");
require_once("$CFG->dirroot/mod/ecodebook/lib.php");
/**
 * Print ecodebook header.
 * @param object $ecodebook
 * @param object $cm
 * @param object $course
 * @return void
 */
function ecodebook_print_header($ecodebook, $cm, $course) {
    global $PAGE, $OUTPUT;

    $PAGE->set_title($course->shortname.': '.$ecodebook->name);
    $PAGE->set_heading($course->fullname);
    $PAGE->set_activity_record($ecodebook);
    echo $OUTPUT->header();
}

/**
 * Print ecodebook heading.
 * @param object $ecodebook
 * @param object $cm
 * @param object $course
 * @param bool $notused This variable is no longer used.
 * @return void
 */
function ecodebook_print_heading($ecodebook, $cm, $course, $notused = false) {
    global $OUTPUT;
    echo $OUTPUT->heading(format_string($ecodebook->name), 2);
}

/**
 * Display ecodebook frames.
 * @param object $ecodebook
 * @param object $cm
 * @param object $course
 * @return does not return
 */
function ecodebook_display_frame($ecodebook, $cm, $course) {
    global $PAGE, $OUTPUT, $CFG;

    $frame = optional_param('frameset', 'main', PARAM_ALPHA);

    if ($frame === 'top') {
        $PAGE->set_pagelayout('frametop');
        ecodebook_print_header($ecodebook, $cm, $course);
        ecodebook_print_heading($ecodebook, $cm, $course);
        echo $OUTPUT->footer();
        die;

    } else {
        $config = get_config('ecodebook');
        $context = context_module::instance($cm->id);
        $navurl = "$CFG->wwwroot/mod/ecodebook/view.php?id=$cm->id&amp;frameset=top";
        $coursecontext = context_course::instance($course->id);
        $courseshortname = format_string($course->shortname, true, array('context' => $coursecontext));
        $title = strip_tags($courseshortname.': '.format_string($ecodebook->name));
        $framesize = $config->framesize;
        $modulename = s(get_string('modulename','ecodebook'));
        $contentframetitle = s(format_string($ecodebook->name));
        $dir = get_string('thisdirection', 'langconfig');

        $extframe = <<<EOF
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html dir="$dir">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>$title</title>
  </head>
  <frameset rows="$framesize,*">
    <frame src="$navurl" title="$modulename"/>
  </frameset>
</html>
EOF;

        @header('Content-Type: text/html; charset=utf-8');
        echo $extframe;
        die;
    }
}

/**
 * Print ecodebook info and link.
 * @param object $ecodebook
 * @param object $cm
 * @param object $course
 * @return does not return
 */
function ecodebook_print_workaround($ecodebook, $cm, $course) {
    $secretData = null;
    global $OUTPUT;
    global $PAGE;
    global $USER;
    global $DB;
    $PAGE->requires->css('/mod/ecodebook/extracss/extracss.css');
    $PAGE->requires->js('/mod/ecodebook/javascript/JS.js');
    ecodebook_print_header($ecodebook, $cm, $course);
    ecodebook_print_heading($ecodebook, $cm, $course, true);
    $title = strip_tags(format_string($ecodebook->name));
    $id = strip_tags(format_string($ecodebook->bookid));
    try
    {
        $secretData  = $DB->get_records_sql('SELECT `bookid`,`host`,`ordersource`,`sharedsecret` FROM {local_ecodebookmanager} WHERE `bookid`="'.$id.'"');
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'locallib Line 136';
    }
    if ($secretData)
    {
        $secretDataArray = array();    
        $secretData = objectToArray($secretData);
        foreach ($secretData as $key => $row) {
            $secretDataArray['ordersource']= $row['ordersource'];
            $secretDataArray['sharedsecret']= $row['sharedsecret'];
            $secretDataArray['host']= $row['host'];
        }
        $ordersource = $secretDataArray['ordersource'];
        $sharedsecret = $secretDataArray['sharedsecret'];
        $host = $secretDataArray['host'];
        $orderid = '859203';
        if ($id == 'LH_02')
        {
            $orderid = '754329';
        }
        $mail =  $USER->email;
        $name =  $USER->firstname.' '.$USER->lastname;
        $fullinfo = array('orderid' => $orderid,'id' => $id,'email' => $mail,'name' => $name,'ordersource' =>$ordersource,'sharedsecret' => $sharedsecret,'host'=>$host);
        $fullinfo  =  json_encode($fullinfo);
        $allinfo = base64_encode($fullinfo);

        echo '<div class="bookcontainer">
        <table class="tableclass">
            <tr><td>
                <a class="aclass" id="'.$allinfo.'"  href="javascript:void(0)"><img src="https://i2.wp.com/www.vivisaar.com/wp-content/uploads/2012/09/110.jpg" alt="Avatar" class="bookimage"></a></td>
                <td>
                <span class="bookoverlay"><a id="'.$allinfo.'" class="aclass" href="javascript:void(0)">'.$title.'</a></span>
                </td>
            </tr>
            </table>
            </div>';
        //echo '<div class="urlworkaround"><h3>';
        //print_string('clicktoopen', 'ecodebook', "<a onclick=\"alert('hiiiii')\" href=\"#\"><img class=\"iconimage\" src=\"/mod/ecodebook/pix/icon.svg\" alt=\"110ecode Book\" width=\"35\" height=\"35\" /><span>  </span>$title</a>");
        //echo '</h3></div>';
    }
    echo $OUTPUT->footer();
    die;
}

/**
 * Get the parameters that may be appended to ecodebook
 * @param object $d
 * @return array array of books
 */
function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }

    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    }
    else {
        // Return array
        return $d;
    }
}
/**
 * Get the parameters that may be appended to mod_ecodebook
 * @param object $config mod_ecodebook module config options
 * @return array array of books
 */
function ecodebook_get_books($config)
{
    global $DB;
    $booktitles = null;
    try
    {
        $booktitles  = $DB->get_records_sql('SELECT `id`,`booktitle`,`bookid`,`host`,`ordersource`,`sharedsecret` FROM mdl_local_ecodebookmanager');
    }
    catch (Exception $e) 
    {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        echo 'locallib Line 220';
    }
    if ($booktitles)
    {
        $bookselect = array();    
        $booktitles = objectToArray($booktitles);
        foreach ($booktitles as $key => $row) {
            $bookselect[$row['bookid'].'###'.$row['host'].'###'.$row['ordersource'].'###'.$row['sharedsecret']]= $row['booktitle'];
        }

        return $bookselect;
    }
    else
    {
        return [];
    }
}

/**
 * Optimised mimetype detection from general mod_ecodebook
 * @param $fullurl
 * @param int $size of the icon.
 * @return string|null mimetype or null when the filetype is not relevant.
 */
function ecodebook_guess_icon($filename, $size = null) {
    global $CFG;
    require_once("$CFG->libdir/filelib.php");

    if (substr_count($filename, '/') < 3 or substr($filename, -1) === '/') {
        // Most probably default directory - index.php, index.html, etc. Return null because
        // we want to use the default module icon instead of the HTML file icon.
        return null;
    }

    $icon = file_extension_icon($filename, $size);
    $htmlicon = file_extension_icon('.htm', $size);
    $unknownicon = file_extension_icon('', $size);

    // We do not want to return those icon types, the module icon is more appropriate.
    if ($icon === $unknownicon || $icon === $htmlicon) {
        return null;
    }

    return $icon;
}
