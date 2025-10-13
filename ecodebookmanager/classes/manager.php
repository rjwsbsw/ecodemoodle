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
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.


/**
 * @package     local_ecodebookmanager
 * @author      Imad Othman
 * @license     http://satzweiss.com/ecodebooks
 */

namespace local_ecodebookmanager;

use dml_exception;
use stdClass;

class manager {

    /** Insert the data into our database table.
     * @param string $book_id
     * @param string $book_title
     * @param string $ordersource
     * @param string $sharedsecret
     *  @param string $host
     * @return bool true if successful
     */
    public function create_book(string $book_id, string $book_title,string $ordersource,string $sharedsecret, string $host): bool
    {
        global $DB;
        $record_to_insert = new stdClass();
        $record_to_insert->bookid = $book_id;
        $record_to_insert->booktitle = $book_title;
        $record_to_insert->ordersource = $ordersource;
        $record_to_insert->sharedsecret = $sharedsecret;
        $record_to_insert->host = $host;
        try {
            return $DB->insert_record('local_ecodebookmanager', $record_to_insert, false);
        } catch (dml_exception $e) {
            return false;
        }
    }

    /** Gets all books that have not been read by this user
     * @return array of books
     */
    public function get_books(): array
    {
        global $DB;
        $sql = "SELECT lm.bookid, lm.booktitle, lm.ordersource,lm.sharedsecret,lm.host
            FROM {local_ecodebookmanager} lm";
        try {
            return $DB->get_records_sql($sql);
        } catch (dml_exception $e) {
            // Log error here.
            return [];
        }
    }

    /** Get a single book from its id.
     * @param $bookidint the book we're trying to get.
     * @return object|false book data or false if not found.
     */
    public function get_book(int $bookidint)
    {
        global $DB;
        return $DB->get_record('local_ecodebookmanager', ['id' => $bookidint]);
    }

    /** Update details for a single book.
     * @param int $id
     * @param string $book_id
     * @param string $book_title
     * @param string $ordersource
     * @param string $sharedsecret
     *  @param string $host
     * @return bool book data or false if not found.
     */
    public function update_book(int $id,string $book_id, string $book_title, string $ordersource, string $sharedsecret, string $host): bool
    {
        global $DB;
        $object = new stdClass();
        $object->id = $id;
        $object->bookid = $book_id;
        $object->booktitle = $book_title;
        $object->ordersource = $ordersource;
        $object->sharesecret = $sharedsecret;
        $object->host = $host;
        return $DB->update_record('local_ecodebookmanager', $object);
    }

    /** Delete a book and all the read history.
     * @param int $bookid
     * @return bool
     * @throws \dml_transaction_exception
     * @throws dml_exception
     */
    public function delete_book($bookid)
    {
        global $DB;
        $transaction = $DB->start_delegated_transaction();
        $deletedBook = $DB->delete_records('local_ecodebookmanager', ['id' => $bookid]);
        if ($deletedBook) {
            $DB->commit_delegated_transaction($transaction);
        }
        return true;
    }
}
