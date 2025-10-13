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

namespace local_ecodebookmanager\form;
use moodleform;

require_once("$CFG->libdir/formslib.php");

class edit extends moodleform {
    //Add elements to form
    public function definition() {
        global $PAGE;
        $PAGE->requires->css('/local/ecodebookmanager/styles/main.css');
        $PAGE->requires->js('/local/ecodebookmanager/javascript/main.js');
        global $CFG;
        $mform = $this->_form; // Don't forget the underscore!
        $mform->addElement('hidden', 'id');
        $mform->setType('id', PARAM_INT);
        $attributes1 =  array('id' => 'idF','placeholder'=>get_string('enter_id', 'local_ecodebookmanager'));
        $attributes2 =  array('id' => 'titleF','placeholder'=>get_string('enter_booktitle', 'local_ecodebookmanager'));
        $attributes3 =  array('id' => 'ordersourcef');
        $attributes4 =  array('id' => 'sharedsecretf');
        $attributes5 =  array('id' => 'host');
        $mform->addElement('text', 'bookid', get_string('book_id', 'local_ecodebookmanager'),$attributes1);
        $mform->setType('bookid', PARAM_NOTAGS);         
        $mform->addRule('bookid', null, 'required', null, 'client');
        $mform->setDefault('bookid', '');        //Default value


        $mform->addElement('text', 'booktitle', get_string('book_title', 'local_ecodebookmanager'),$attributes2); // Add elements to your form
        $mform->setType('booktitle', PARAM_NOTAGS);                   //Set type of element
        $mform->addRule('booktitle', null, 'required', null, 'client');
        $mform->setDefault('booktitle', '');        //Default value

        $mform->addElement('hidden', 'ordersource', get_string('ordersource', 'local_ecodebookmanager'),$attributes3); // Add elements to your form
        $mform->setType('ordersource', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('ordersource', get_config('local_ecodebookmanager', 'ordersource')); 

        $mform->addElement('hidden', 'sharedsecret', get_string('sharedsecret', 'local_ecodebookmanager'),$attributes4); // Add elements to your form
        $mform->setType('sharedsecret', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('sharedsecret', get_config('local_ecodebookmanager', 'sharedsecret')); 

        $mform->addElement('hidden', 'host', get_string('host', 'local_ecodebookmanager'),$attributes5); // Add elements to your form
        $mform->setType('host', PARAM_NOTAGS);                   //Set type of element
        $mform->setDefault('host', get_config('local_ecodebookmanager', 'host'));

        $this->add_action_buttons($cancel = true, $submitlabel=get_string('savechnages', 'local_ecodebookmanager'));
        
    }
    //Custom validation should be added here
    
    function validation($data, $files) {
        return array();
    }
}
