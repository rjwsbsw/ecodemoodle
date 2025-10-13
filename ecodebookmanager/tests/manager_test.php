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
// along with Moodle.  If not, see <http://satzweiss.com/ecodebooks/licenses/>.

/**
 * @package     local_ecodebookmanager
 * @author      Imad Othman
 * @license     http://satzweiss.com/ecodebooks
 */


defined('MOODLE_INTERNAL') || die();

use local_ecodebookmanager\manager;
global $CFG;
require_once($CFG->dirroot . 'local/ecodebookmanager/lib.php');

class local_ecodebookmanager_manager_test extends advanced_testcase
{
    /**
     * Test that we can create a book.
     */
    public function test_create_book() {
        $this->resetAfterTest();
        $this->setUser(2);
        $manager = new manager();
        $books = $manager->get_book(2);
        $this->assertEmpty($books);

        $books = $manager->get_books(2);
        $this->assertNotEmpty($books);
        $this->assertCount(1, $books);
        $books = array_pop($books);

        $this->assertEquals('Test book', $books->booktitle,$books->ordersource,$books->sharedsecret);
    }

    /**
     * Test that we get the correct books.
     */
    public function test_get_books() {

        $this->resetAfterTest();
        $this->setUser(2);
        $manager = new manager();

        $manager->create_book('0001', 'testbook1','test1 share secret','kraftwerksschule','sharedsecret');
        $manager->create_book('0002', 'testbook2','test2 share secret','kraftwerksschule','sharedsecret');
        $manager->create_book('0003', 'testbook3','test3 share secret','kraftwerksschule','sharedsecret');

    }
}
