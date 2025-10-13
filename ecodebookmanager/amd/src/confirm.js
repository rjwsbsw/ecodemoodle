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
// along with Moodle.  If not, see <http://www.htw.org>

/**
 *
 * @module  local_ecodebookmanager
 */
define(['jquery', 'core/modal_factory', 'core/str', 'core/modal_events', 'core/ajax', 'core/notification'], function($, ModalFactory, String, ModalEvents, Ajax, Notification) {
    var trigger = $('.local_ecodebookmanager_delete_button');
    ModalFactory.create({
        type: ModalFactory.types.SAVE_CANCEL,
        title: String.get_string('delete_book', 'local_ecodebookmanager'),
        body: String.get_string('delete_book_confirm', 'local_ecodebookmanager'),
        preShowCallback: function(triggerElement, modal) {
            // Do something before we show the delete modal.
            triggerElement = $(triggerElement);
            let classString = triggerElement[0].classList[0]; // ecode_bookid13
            let bookid = classString.substr(classString.lastIndexOf('local_ecodebookmanagerid') + 'local_ecodebookmanagerid'.length);
            // Set the book id in this modal.
            modal.params = {'bookid': bookid};
            modal.setSaveButtonText(String.get_string('delete_book', 'local_ecodebookmanager'));
        },
        large: true,
    }, trigger)
        .done(function(modal) {
            // Do what you want with your new modal.
            modal.getRoot().on(ModalEvents.save, function(e) {
                // Stop the default save button behaviour which is to close the modal.
                e.preventDefault();

                let footer = Y.one('.modal-footer');
                footer.setContent(String.get_string('deleting', 'local_ecodebookmanager'));
                let spinner = M.util.add_spinner(Y, footer);
                spinner.show();
                let request = {
                    methodname: 'local_ecodebookmanager_delete_book',
                    args: modal.params,
                };
                Ajax.call([request])[0].done(function(data) {
                    if (data === true) {
                        // Redirect to manage page.
                        window.location.reload();
                    } else {
                        Notification.addNotification({
                            message: String.get_string('delete_book_failed', 'local_ecodebookmanager'),
                            type: 'error',
                        });
                    }
                }).fail(Notification.exception);
            });
        });

});
