<?php

/**
 * local_ecodebookmanager external file
 *
 * @package    component
 * @category   external
 * @license   http://satzweiss.com/local_ecodebookmanager
 */

defined('MOODLE_INTERNAL') || die();

use local_ecodebookmanager\manager;
require_once($CFG->libdir . "/externallib.php");

class local_ecodebookmanager_external extends external_api  {
    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function delete_book_parameters() {
        return new external_function_parameters(
            ['bookid' => new external_value(PARAM_INT, 'id of book')],
        );
    }

    /**
     * The function itself
     * @return string welcome book
     */
    public static function delete_book($bookid): string {
        $params = self::validate_parameters(self::delete_book_parameters(), array('bookid'=>$bookid));

        require_capability('local/ecodebookmanager:managebooks', context_system::instance());

        $manager = new manager();
        return $manager->delete_book($bookid);
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function delete_book_returns() {
        return new external_value(PARAM_BOOL, 'True if the book was successfully deleted.');
    }
}
