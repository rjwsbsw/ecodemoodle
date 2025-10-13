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
 * EcodeBook configuration form
 *
 * @package    mod_ecodebook
 * @copyright  2009 Petr Skoda  {@link http://skodak.org}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

require_once ($CFG->dirroot.'/course/moodleform_mod.php');
require_once($CFG->dirroot.'/mod/ecodebook/locallib.php');
$PAGE->requires->js('/mod/ecodebook/javascript/init.js');
class mod_ecodebook_mod_form extends moodleform_mod {
    function definition() {
        $mform = $this->_form;
        $config = get_config('ecodebook');
        $bookselect = ecodebook_get_books($config);
        //-------------------------------------------------------
        $javascript = "
        try
        {
            document.getElementById('namelable').value = this.options[this.selectedIndex].text;
            var getvalue =  $(this).val();
            if (getvalue)
            {
                getvalues = getvalue.split('###');
                document.getElementById('bookidlable').value = getvalues[0].trim();
                document.getElementById('host').value = getvalues[1].trim();
                document.getElementById('ordersourcelable').value = getvalues[2].trim();
                document.getElementById('sharedsecretlable').value = getvalues[3].trim();
            }
            
        } catch (error) 
        {
            document.getElementById('bookidlable').value = '';
            document.getElementById('namelable').value = '';
            document.getElementById('ordersourcelable').value = '';
            document.getElementById('sharedsecretlable').value = '';
            document.getElementById('host').value = '';
        }
      
        ";
        $attributes =  array('onchange' => "javascript: $javascript",'id' => "selectbooksid");
        $nameattr =  array('id' => "namelable");
        $bookidlable =  array('id' => "bookidlable");
        $ordersourcelable =  array('id' => "ordersourcelable");
        $sharedsecretlable = array('id' => "sharedsecretlable");
        $host = array('id' => "host");
        $mform->addElement('header', 'general', get_string('general', 'form'));
        $mform->addElement('hidden', 'ordersource','',$ordersourcelable);
        $mform->addElement('hidden', 'sharedsecret','',$sharedsecretlable);
        $mform->addElement('hidden', 'host','',$host);
        $mform->setType('ordersource', PARAM_RAW);
        $mform->setType('sharedsecret', PARAM_RAW);
        $mform->setType('host', PARAM_RAW);
        $mform->addElement('select', 'select_book', get_string('chooseabook', 'ecodebook'),$bookselect, $attributes);
        
        $mform->addElement('hidden', 'name','',$nameattr);
        $mform->setType('name', PARAM_RAW);
        $mform->addElement('hidden', 'bookid','',$bookidlable);
        $mform->setType('bookid', PARAM_RAW);

        
        
        //-------------------------------------------------------
        $this->standard_coursemodule_elements();

        //-------------------------------------------------------
        $this->add_action_buttons($cancel=true, $submitlabel=false, $submit2label=null);
        
    }

    function validation($data, $files) 
    {
            return array();

    }

}
