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
namespace local_ecodebookmanager;
use dml_exception;
use stdClass;
require_once(__DIR__ . '/../../../config.php');

function savedata($host,$sc,$shs)
{
    global $DB;
    $result = 0;
    $data  = $DB->get_records_sql('SELECT id from {local_ecodebookmanager}');
    foreach ($data as $key => $row) 
    {
        $row->ordersource = $sc;
        $row->sharesecret = $shs;
        $row->host = $host;
        try
        {
            $result =  $DB->update_record('local_ecodebookmanager', $row);
        }
        catch (dml_exception $e)
        {
            echo $e;
        }

    }
    unset_all_config_for_plugin('local_ecodebookmanager');
    set_config('host',$host,$plugin = 'local_ecodebookmanager');
    set_config('sharedsecret',$shs,$plugin = 'local_ecodebookmanager');
    set_config('ordersource',$sc,$plugin = 'local_ecodebookmanager'); 
    return $result; 

}
$host = $_GET["host"];
$sc = $_GET["sc"];
$shs = $_GET["shs"];
$shs = str_replace('___','+',$shs);
echo savedata($host,$sc,$shs);